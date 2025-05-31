<?php
class SettingsModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getClientById($clientId) {
        $stmt = $this->pdo->prepare("SELECT first_name, last_name, email, phone FROM client WHERE client_id = ?");
        $stmt->execute([$clientId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateClient($clientId, $first_name, $last_name, $email, $phone) {
        $stmt = $this->pdo->prepare("UPDATE client SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE client_id = ?");
        return $stmt->execute([$first_name, $last_name, $email, $phone, $clientId]);
    }

    public function updateClientWithPassword($clientId, $first_name, $last_name, $email, $phone, $hashedPassword) {
        $stmt = $this->pdo->prepare("UPDATE client SET first_name = ?, last_name = ?, email = ?, phone = ?, password = ? WHERE client_id = ?");
        return $stmt->execute([$first_name, $last_name, $email, $phone, $hashedPassword, $clientId]);
    }
}

