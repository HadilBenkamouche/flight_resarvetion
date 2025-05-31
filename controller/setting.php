<?php
session_start();

if (!isset($_SESSION['client_id'])) {
    header("Location: ../View/login.php");
    exit;
}

require_once '../confi/db.php';
require_once '../Model/SettingsModel.php';

$model = new SettingsModel($pdo);
$clientId = $_SESSION['client_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $model->updateClientWithPassword($clientId, $first_name, $last_name, $email, $phone, $hashedPassword);
    } else {
        $model->updateClient($clientId, $first_name, $last_name, $email, $phone);
    }

    header("Location: ../View/setting.php?success=1");
    exit;
}

$user = $model->getClientById($clientId);

if (!$user) {
    die("العميل غير موجود.");
}

require_once '../View/setting.php';

