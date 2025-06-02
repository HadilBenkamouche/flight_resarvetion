<?php
class Client {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // دالة التسجيل
    public function register($firstName, $lastName, $email, $password) {
        
    
        // تشفير كلمة المرور
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // الاستعلام لإدخال بيانات العميل في قاعدة البيانات
        $sql = "INSERT INTO client (first_name, last_name, email, password)
                VALUES (?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$firstName, $lastName, $email, $hashedPassword]);
    }
    
    // دالة التحقق من كلمة المرور
    private function validatePassword($password) {
        // تعبير منتظم للتحقق من أن كلمة المرور تحتوي على 8 شيفرات مختلطة بين الأحرف والأرقام والرموز
        $regex = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        return preg_match($regex, $password); // إرجاع true إذا كانت كلمة المرور صالحة
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
    
  public function getClientById($clientId) {
        $sql = "SELECT * FROM client WHERE client_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$clientId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ دالة التحديث
    public function updateClient($clientId, $firstName, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE client SET first_name = ?, email = ?, password = ? WHERE client_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$firstName, $email, $hashedPassword, $clientId]);
    }



// ✅ جلب جميع المستخدمين (باستثناء الأدمن)
    public function getAllClients() {
        $sql = "SELECT * FROM client WHERE role = 'client'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ حذف مستخدم
   public function deleteClientById($clientId) {
    $stmt = $this->db->prepare("DELETE FROM Client WHERE client_id = ?");
    return $stmt->execute([$clientId]);
}

   

public function emailExists($email, $excludeClientId = null) {
    $sql = "SELECT COUNT(*) FROM client WHERE email = :email";

    // إذا كنت تريد تجاهل مستخدم معين (مثلاً أثناء التعديل)
    if ($excludeClientId !== null) {
        $sql .= " AND id != :id";
    }

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    if ($excludeClientId !== null) {
        $stmt->bindParam(':id', $excludeClientId, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}





}

?>



