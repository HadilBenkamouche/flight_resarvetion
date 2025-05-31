<?php
require_once '../../Model/client.php';

require_once '../../confi/db.php';


if (isset($_GET['id'])) {
    $clientId = $_GET['id'];

    $clientModel = new Client($pdo);
    $success = $clientModel->deleteClientById($clientId);

    if ($success) {
        header("Location: manage-user.php?deleted=1");
        exit();
    } else {
        header("Location: manage-user.php?deleted=0");
        exit();
    }
} else {
    echo "Invalid request.";
}
?>