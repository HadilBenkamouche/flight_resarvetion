<?php
class Flight {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // جلب جميع الرحلات مع اسم الشركة ونوع الطائرة
    public function getAllFlights() {
        $sql = "SELECT f.*, c.name AS company_name, a.model AS aircraft_model
                FROM Flight f
                JOIN Company c ON f.company_code = c.company_code
                JOIN Aircraft a ON f.aircraft_code = a.aircraft_code";

        $stmt = $this->db->query($sql);
        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    // جلب تفاصيل رحلة باستخدام رقم الرحلة
    public function getFlightByNumber($flight_number) {
        $sql = "SELECT f.*, c.name AS company_name, a.model AS aircraft_model
                FROM Flight f
                JOIN Company c ON f.company_code = c.company_code
                JOIN Aircraft a ON f.aircraft_code = a.aircraft_code
                WHERE f.flight_number = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$flight_number]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // البحث عن الرحلات حسب المعايير (بدون flightClass)
    public function searchFlights($from, $to, $date, $tripType, $passengers) {
        $sql = "SELECT f.*, 
                       dep_city.name AS departure_city, 
                       arr_city.name AS arrival_city,
                       c.name AS company_name,
                       a.model AS aircraft_model,
                       a.capacity - IFNULL(r.booked_seats, 0) AS available_seats
                FROM Flight f
                JOIN FlightRoute fr ON f.flight_number = fr.flight_number
                JOIN Airport dep ON fr.departure_airport = dep.iata_code
                JOIN Airport arr ON fr.arrival_airport = arr.iata_code
                JOIN City dep_city ON dep.city_code = dep_city.city_code
                JOIN City arr_city ON arr.city_code = arr_city.city_code
                JOIN Company c ON f.company_code = c.company_code
                JOIN Aircraft a ON f.aircraft_code = a.aircraft_code
                LEFT JOIN (
                    SELECT flight_number, COUNT(*) AS booked_seats
                    FROM Reservation
                    GROUP BY flight_number
                ) r ON f.flight_number = r.flight_number
                WHERE dep_city.name = ? 
                  AND arr_city.name = ? 
                  AND DATE(f.departure_time) = ? 
                  AND f.flight_type = ?
                HAVING available_seats >= ?";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$from, $to, $date, $tripType, $passengers]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}




