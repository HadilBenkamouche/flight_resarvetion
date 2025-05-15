<?php
class Reservation {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // إضافة الحجز مع معالجة الأخطاء
public function addReservation($data) {
    try {
        $stmt = $this->pdo->prepare("INSERT INTO reservation (reservation_date, status, class_name, client_id, flight_number, total_price) 
                                     VALUES (:reservation_date, :status, :class_name, :client_id, :flight_number, :total_price)");
        $stmt->execute([
            ':reservation_date' => $data['reservation_date'],
            ':status' => $data['status'],
            ':class_name' => $data['class_name'],
            ':client_id' => $data['client_id'],
            ':flight_number' => $data['flight_number'],
            ':total_price' => $data['total_price']
        ]);
        return $this->pdo->lastInsertId(); // هذا يُعيد رقم الحجز المُولَّد
    } catch (PDOException $e) {
        error_log("Error in addReservation: " . $e->getMessage());
        return false;
    }
}

    // إضافة المسافر مع معالجة الأخطاء
    
public function addPassenger($data) {
    try {
        $this->pdo->beginTransaction();

        // 1. توليد identity_number جديد
        $sql = "SELECT identity_number FROM passenger ORDER BY identity_number DESC LIMIT 1";
        $result = $this->pdo->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $lastId = $row['identity_number'];
            $num = (int)substr($lastId, 1); // حذف الحرف P
            $newNum = $num + 1;
        } else {
            $newNum = 1;
        }

        $newIdentityNumber = 'P' . str_pad($newNum, 3, '0', STR_PAD_LEFT);

        // 2. إضافة المسافر
        $stmt = $this->pdo->prepare("
            INSERT INTO passenger (identity_number, first_name, last_name, email, phone)
            VALUES (:identity_number, :first_name, :last_name, :email, :phone)
        ");
        $stmt->execute([
            ':identity_number' => $newIdentityNumber,
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':phone' => $data['phone']
        ]);

        // 3. ربط المسافر بالحجز
       $stmt = $this->pdo->prepare("
    INSERT INTO includes (reservation_number, passenger_id)
    VALUES (:reservation_number, :passenger_id)
");
$stmt->execute([
    ':reservation_number' => $data['reservation_number'], // ← هذا الآن int
    ':passenger_id' => $newIdentityNumber
]);

        $this->pdo->commit();
        return true;

    } catch (PDOException $e) {
        $this->pdo->rollBack();
        echo "خطأ في إضافة المسافر: " . $e->getMessage();
        exit;
        return false;
    }
}

    // إضافة الدفع مع معالجة الأخطاء
    public function addPayment($data) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO payment (reservation_number, card_name, card_number, expiry_date, cvv, created_at) 
                                     VALUES (:reservation_number, :card_name, :card_number, :expiry_date, :cvv, :created_at)");
            return $stmt->execute([
                ':reservation_number' => $data['reservation_number'],
                ':card_name' => $data['card_name'],
                ':card_number' => $data['card_number'],
                ':expiry_date' => $data['expiry_date'],
                ':cvv' => $data['cvv'],
                ':created_at' => $data['created_at']
            ]);
        } catch (PDOException $e) {
            error_log("Error in addPayment: " . $e->getMessage());
            return false;
        }
    }

    // تحديث حالة الحجز
    public function updateReservationStatus($reservationNumber, $status) {
        try {
            $stmt = $this->pdo->prepare("UPDATE reservation SET status = :status WHERE reservation_number = :reservation_number");
            return $stmt->execute([
                ':status' => $status,
                ':reservation_number' => $reservationNumber
            ]);
        } catch (PDOException $e) {
            error_log("Error in updateReservationStatus: " . $e->getMessage());
            return false;
        }
    }
}






