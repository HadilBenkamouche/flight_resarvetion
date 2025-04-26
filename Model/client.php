<?php
class Client {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function register($firstName, $lastName, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO client (first_name, last_name, email, password)
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$firstName, $lastName, $email, $hashedPassword]);
    }
}
?>


