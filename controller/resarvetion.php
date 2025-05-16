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
        header("Location: /flight_resarvetion/controller/resarvetion.php?action=showConfirmation&reservation_number=" . $_SESSION['reservation_number']);
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
$reservationNumber = $_SESSION['reservation_number'];
    if ($_GET['action'] === 'showConfirmation' && isset($_GET['reservation_number'])) {
   error_log("✅ دخلنا في showConfirmation");
error_log("رقم الحجز: " . $_GET['reservation_number']);

    $reservationNumber = $_GET['reservation_number'];
    $details = $reservationModel->getReservationDetails($reservationNumber);

    error_log("📦 تفاصيل الحجز: " . print_r($details, true));

    if ($details) {
        $_SESSION['confirmation_details'] = $details;
        error_log("🔁 سيتم التحويل إلى صفحة التأكيد");
        require_once ' ../View/resarvetion/book_confirmide.php';
        exit;
    } else {
        $_SESSION['error'] = "تعذر العثور على تفاصيل الحجز.";
        error_log("❌ لم يتم العثور على تفاصيل الحجز.");
        header("Location: ../View/resarvetion/paymentpage.php");
        exit;
    }
}


} // ← ✅ إغلاق القوس المفقود



// إذا وصل إلى هنا يعني هناك خطأ في الطلب
$_SESSION['error'] = "طلب غير صحيح";
header("Location: ../View/resarvetion/booking.php");
exit;







