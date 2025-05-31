<?php
require_once __DIR__ . '/../confi/db.php';
require_once __DIR__ . '/../Model/client.php';

class ClientAdminController {
    private $clientModel;

    public function __construct($pdo) {
        // مرر الاتصال إلى الموديل
        $this->clientModel = new Client($pdo);
    }

    public function getAllClients() {
        return $this->clientModel->getAllClients();
    }

    public function getClientById($id) {
        return $this->clientModel->getClientById($id);
    }

    public function updateClient($id, $firstName, $lastName, $email, $phone) {
        return $this->clientModel->updateClient($id, $firstName, $lastName, $email, $phone);
    }

    public function emailExists(string $email, ?int $excludeUserId = null): bool {
        // نستخدم الدالة من الموديل
        return $this->clientModel->emailExists($email, $excludeUserId);
    }
}