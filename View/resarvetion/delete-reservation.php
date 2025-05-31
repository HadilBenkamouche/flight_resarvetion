<?php
session_start();
require_once '../../Model/reservtion.php';  // تأكدي من الاسم الصحيح!
require_once '../../confi/db.php';

$reservationModel = new Reservation($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservationNumber = $_POST['reservation_number'] ?? null;

    if ($reservationNumber) {
        $deleted = $reservationModel->deleteReservation($reservationNumber);
        if ($deleted) {
            $_SESSION['message'] = " Deleted successfully";
        } else {
            $_SESSION['message'] = " Not deleted " ;
        }
    }
    header("Location: managereservation.php");
    exit;
}
?>