<?php
class Airport {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // مطارات الانطلاق فقط
    public function getDepartureAirports() {
        $sql = "SELECT DISTINCT a.iata_code, a.airport_name, c.name AS city_name
                FROM Airport a
                JOIN City c ON a.city_code = c.city_code
                JOIN FlightRoute fr ON fr.departure_airport = a.iata_code";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // مطارات الوصول فقط
    public function getArrivalAirports() {
        $sql = "SELECT DISTINCT a.iata_code, a.airport_name, c.name AS city_name
                FROM Airport a
                JOIN City c ON a.city_code = c.city_code
                JOIN FlightRoute fr ON fr.arrival_airport = a.iata_code";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

