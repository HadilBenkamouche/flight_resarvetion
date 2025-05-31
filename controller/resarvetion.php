<?php
require_once '../confi/db.php';
require_once '../Model/reservtion.php';
require_once '../Model/flight.php';
// بدء الجلسة بشكل آمن
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// التحقق من تسجيل دخول العميل
if (!isset($_SESSION['client_id'])) {
    header("Location: ../View/client/login.php");
    exit;
}

$reservationModel = new Reservation($pdo);
$flightModel = new Flight($pdo);

     // عرض صفحة التأكيد
if (isset($_GET['action']) && $_GET['action'] === 'showConfirmation') {
    $reservationNumber = (int)$_GET['reservation_number'];

    // جلب تفاصيل الحجز (تشمل بيانات الرحلة أيضاً)
    $reservationDetails = $reservationModel->getReservationDetails($reservationNumber);

    if (!$reservationDetails) {
        $_SESSION['error'] = "رقم الحجز غير موجود.";
        header("Location: ../View/resarvetion/booking.php");
        exit;
    }

    // جلب بيانات الركاب
    $passengers = $reservationModel->getPassengersByReservation($reservationNumber);

    // حفظ البيانات في الجلسة
    $_SESSION['confirmation_details'] = [
        'reservation' => $reservationDetails,
        'passengers' => $passengers,
    ];
// إعادة التوجيه لصفحة التأكيد
header("Location: ../View/resarvetion/book_confirmide.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'addReservation') {
        
        $flightNumber = $_POST['flight_number'];
        $class = $_POST['class_name'];
        $passengerCount = count($_POST['first_name']);

        // جلب معلومات الرحلة
        $flight = $flightModel->getFlightByNumber($flightNumber);

        // تحديد السعر حسب الكلاس
        switch ($class) {
            case 'Economy':
                $unitPrice = $flight['economy_price'];
                break;
            case 'Business':
                $unitPrice = $flight['business_price'];
                break;
            case 'First Class':
                $unitPrice = $flight['first_class_price'];
                break;
            default:
                $unitPrice = 0;
        }

        // حساب السعر الإجمالي
        $totalPrice = $unitPrice * $passengerCount;

        // تجهيز بيانات الحجز
        $reservationDate = date('Y-m-d H:i:s');
        $reservationData = [
            'reservation_date' => $reservationDate,
            'status' => 'Pending',
            'class_name' => $class,
            'client_id' => $_SESSION['client_id'],
            'flight_number' => $flightNumber,
            'total_price' => $totalPrice
        ];
 // عرض الحجوزات الخاصة بالمستخدم الحالي
      if (isset($_GET['action']) && $_GET['action'] === 'Viewreservation') {
      $reservations = $reservationModel->getReservationsByClientId($_SESSION['client_id']);
      require_once '../View/client/reservation.php';
       exit;
     }
      // عرض الحجوزات القادمة للمستخدم الحالي
     if (isset($_GET['action']) && $_GET['action'] === 'upcoming') {
      $upcomingBookings = $reservationModel->getUpcomingBookingsByClientId($_SESSION['client_id']);
      require_once '../View/resarvetion/upcomingbookings.php';
     exit;
     }
       
       
       // تنفيذ الحجز
 $reservationNumber = $reservationModel->addReservation($reservationData);

        if ($reservationNumber) {
            $passengers = [];
            for ($i = 0; $i < $passengerCount; $i++) {
                $passengers[] = [
                    'first_name' => $_POST['first_name'][$i],
                    'last_name' => $_POST['last_name'][$i],
                    'email' => $_POST['email'][$i],
                    'phone' => $_POST['phone'][$i],
                ];
            }

            $allPassengersAdded = true;

            foreach ($passengers as $passenger) {
                $passengerData = [
                    'reservation_number' => $reservationNumber,
                    'first_name' => $passenger['first_name'],
                    'last_name' => $passenger['last_name'],
                    'email' => $passenger['email'],
                    'phone' => $passenger['phone']
                ];
            
                if (!$reservationModel->addPassenger($passengerData)) {
                    $allPassengersAdded = false;
                    break;
                }
            }
            
            if ($allPassengersAdded) {
                $_SESSION['reservation_number'] = $reservationNumber;
                header("Location: ../View/resarvetion/paymentpage.php");
                exit;
            } else {
                $reservationModel->updateReservationStatus($reservationNumber, 'Cancelled');
                $_SESSION['error'] = "حدث خطأ أثناء إضافة بيانات المسافرين.";
                header("Location: ../View/resarvetion/booking.php");
                exit;
            }
        }
    }

    // معالجة الدفع
    if ($_POST['action'] === 'addPayment') {
        if (!isset($_SESSION['reservation_number'])) {
            $_SESSION['error'] = "رقم الحجز غير موجود في الجلسة. تأكد من أنك أتممت الحجز أولاً";
            header("Location: ../View/resarvetion/booking.php");
            exit;
        }

    $reservationNumber = $_SESSION['reservation_number'];
        $paymentData = [
            'reservation_number' => $_SESSION['reservation_number'],
            'card_name' => $_POST['card_name'],
            'card_number' => $_POST['card_number'],
            'expiry_date' => $_POST['expiry_date'],
            'cvv' => $_POST['cvv'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($reservationModel->addPayment($paymentData)) {
            if ($reservationModel->updateReservationStatus($_SESSION['reservation_number'], 'Confirmed')) {
                   $reservationNumber = $_SESSION['reservation_number'];
                header("Location: http://localhost/flight_resarvetion/controller/resarvetion.php?action=showConfirmation&reservation_number=" . $reservationNumber);
                            exit;

                  } else {
                $_SESSION['error'] = "حدث خطأ أثناء تحديث حالة الحجز";
                header("Location: ../View/resarvetion/paymentpage.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "حدث خطأ أثناء معالجة الدفع";
            header("Location: ../View/resarvetion/paymentpage.php");
            exit;
        }
    }


      
    
    //all resevations
        
    
    

    
    

    // تعديل بيانات الحجز بشكل عام
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        // Sanitize and validate input
        $reservationNumber = $_POST['reservation_number'] ?? null;
        $flightNumber = $_POST['flight_number'] ?? null;
        $status = $_POST['status'] ?? null;
        $className = $_POST['class'] ?? null;

        if (!$reservationNumber || !$status || !$className || !$flightNumber) {
            die("❌ All fields are required.");
        }

        // Initialize model
        $reservationModel = new Reservation($pdo);

        // Update reservation
        $success = $reservationModel->updateReservation($reservationNumber, $status, $className);

        if ($success) {
            echo "<script>alert('✅ Reservation updated successfully.'); window.location.href = '../View/reservation/list.php';</script>";
        } else {
            echo "<script>alert('❌ Failed to update reservation.'); history.back();</script>";
        }
    } else {
        die("❌ Invalid form action.");
    }
} else {
    die("❌ Invalid request method.");
}
    

    // حذف الحجز
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_number'])) {
            $reservationNumber = $_POST['reservation_number'];

            $success = $this->reservationModel->deleteReservation($reservationNumber);
            if ($success) {
                header("Location: reservations.php?message=تم حذف الحجز بنجاح");
                exit;
            } else {
                die("فشل حذف الحجز");
            }
        } else {
            die("رقم الحجز غير محدد");
        }
    
    


} // ← ✅ إغلاق القوس المفقود











