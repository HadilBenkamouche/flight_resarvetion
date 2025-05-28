<?php

class AdminModel {

     private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // جلب جميع الشركات
    public function getAllCompanies() {
        $sql = "SELECT * FROM Company";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // جلب جميع الطائرات
    public function getAllAircraft() {
        $sql = "SELECT * FROM Aircraft";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // جلب جميع المطارات
    public function getAllAirports() {
        $sql = "SELECT * FROM Airport";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public function getAllCities() {
    $sql = "SELECT * FROM City";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




}