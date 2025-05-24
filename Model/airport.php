<?php
class Airport {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // جلب جميع المطارات مع أسماء المدن المرتبطة بها
    public function getAllAirportsWithCities() {
        $sql = "SELECT a.iata_code, a.airport_name, a.airport_type, c.name AS city_name
                FROM Airport a
                JOIN City c ON a.city_code = c.city_code
                ORDER BY c.name, a.airport_name";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
