<?php
class Client {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // دالة التسجيل
    public function register($firstName, $lastName, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO client (first_name, last_name, email, password)
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$firstName, $lastName, $email, $hashedPassword]);
    }

    // ✅ دالة تسجيل الدخول
    public function loginWithEmail($email, $password) {
        $sql = "SELECT client_id, first_name, last_name, email, password, role FROM client WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // طباعة المتغير لتتأكد من البيانات
        var_dump($user);
    
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
    
        return false;
    }
    }

?>



