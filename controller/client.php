
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../Model/client.php';
require_once '../confi/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        $username = trim($_POST['username']);
        $email = $_POST['email'];
        $password = $_POST['password'];

        $nameParts = explode(" ", $username, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

        $client = new Client($pdo);
        $result = $client->register($firstName, $lastName, $email, $password);

        if ($result) {
            echo "تم التسجيل بنجاح!";
        } else {
            echo "فشل في التسجيل.";
        }
    } else {
        echo "يرجى ملء جميع الحقول.";
    }
}
?>



