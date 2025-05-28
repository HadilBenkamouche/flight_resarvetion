<?php
class Flight {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // جلب جميع الرحلات مع اسم الشركة ونوع الطائرة
  public function getAllFlights() {
    $sql = "SELECT f.*, 
                   c.name AS company_name, 
                   a.model AS aircraft_model,
                   dep_city.name AS departure_city,
                   arr_city.name AS arrival_city
            FROM Flight f
            JOIN Company c ON f.company_code = c.company_code
            JOIN Aircraft a ON f.aircraft_code = a.aircraft_code
            JOIN FlightRoute fr ON f.flight_number = fr.flight_number
            JOIN Airport dep_airport ON fr.departure_airport = dep_airport.iata_code
            JOIN Airport arr_airport ON fr.arrival_airport = arr_airport.iata_code
            JOIN City dep_city ON dep_airport.city_code = dep_city.city_code
            JOIN City arr_city ON arr_airport.city_code = arr_city.city_code";

    $stmt = $this->db->query($sql);
    if ($stmt) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}


    // جلب تفاصيل رحلة باستخدام رقم الرحلة
    public function searchFlights($fromAirportCode, $toAirportCode, $date, $tripType, $passengers) {
$sql = "SELECT f.*, 
               dep_city.name AS departure_city, 
               arr_city.name AS arrival_city,
               c.name AS company_name,
               a.model AS aircraft_model,
               (a.capacity - COALESCE(r.booked_seats, 0)) AS available_seats
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
        WHERE dep.iata_code = ? 
          AND arr.iata_code = ? 
          AND DATE(f.departure_time) = ? 
          AND f.flight_type = ? 
        HAVING available_seats >= ?";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$fromAirportCode, $toAirportCode, $date, $tripType, $passengers]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    
    public function getFlightByNumber($flightNumber) {
        $sql = "
            SELECT 
                f.flight_number,
                arr_airport.airport_name AS destination_airport_name,
                f.departure_time,
                f.arrival_time,
                f.flight_type,
                f.economy_price,
                f.business_price,
                f.first_class_price,
                c.name AS company_name,
                a.model AS aircraft_model,
                a.first_seats,
                a.business_seats,
                a.economy_seats,
                COUNT(CASE WHEN r.class_name= 'first' THEN 1 END) AS reserved_first,
                COUNT(CASE WHEN r.class_name = 'business' THEN 1 END) AS reserved_business,
                COUNT(CASE WHEN r.class_name = 'economy' THEN 1 END) AS reserved_economy
            FROM Flight f
            JOIN Company c ON f.company_code = c.company_code
            JOIN Aircraft a ON f.aircraft_code = a.aircraft_code
            JOIN FlightRoute fr ON f.flight_number = fr.flight_number
            JOIN Airport arr_airport ON fr.arrival_airport = arr_airport.iata_code
            LEFT JOIN Reservation r ON f.flight_number = r.flight_number
            LEFT JOIN includes i ON r.reservation_number = i.reservation_number
            WHERE f.flight_number = ?
            GROUP BY f.flight_number
            LIMIT 1
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$flightNumber]);
        $flight = $stmt->fetch(PDO::FETCH_ASSOC);
        
    
        if ($flight) {
            // حساب المقاعد المتبقية ديناميكياً
            $flight['remaining_first_seats'] = $flight['first_seats'] - $flight['reserved_first'];
            $flight['remaining_business_seats'] = $flight['business_seats'] - $flight['reserved_business'];
            $flight['remaining_economy_seats'] = $flight['economy_seats'] - $flight['reserved_economy'];
        }
    
        return $flight;
    }
    
    
    
     
  public function addFlight($flightNumber, $flightType, $companyCode, $aircraftCode,
                          $departure, $arrival, $destination,
                          $firstPrice, $businessPrice, $economyPrice) {

    $sql = "INSERT INTO flight (
                flight_number, flight_type, company_code, aircraft_code,
                departure_time, arrival_time, destination,
                first_class_price, business_price, economy_price
            ) VALUES (
                :flight_number, :flight_type, :company_code, :aircraft_code,
                :departure_time, :arrival_time, :destination,
                :first_price, :business_price, :economy_price
            )";

    $stmt = $this->db->prepare($sql);

    $stmt->bindParam(':flight_number', $flightNumber);
    $stmt->bindParam(':flight_type', $flightType);
    $stmt->bindParam(':company_code', $companyCode);
    $stmt->bindParam(':aircraft_code', $aircraftCode);  // تأكد من الاسم في الجدول
    $stmt->bindParam(':departure_time', $departure);
    $stmt->bindParam(':arrival_time', $arrival);
    $stmt->bindParam(':destination', $destination);
    $stmt->bindParam(':first_price', $firstPrice);
    $stmt->bindParam(':business_price', $businessPrice);
    $stmt->bindParam(':economy_price', $economyPrice);

    return $stmt->execute();
}

   public function deleteFlight($flightNumber) {
        $sql = "DELETE FROM Flight WHERE flight_number = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$flightNumber]);
    }

// دالة جلب رحلات الذهاب والعودة 

public function searchRoundTripFlights($departureAirportId, $arrivalAirportId, $departureDate, $returnDate) {
        // جلب رحلات الذهاب
        $stmt1 = $this->db->prepare("
            SELECT f.*, fr.departure_airport, fr.arrival_airport,
                   da.airport_name AS departure_airport_name,
                   aa.airport_name AS arrival_airport_name
            FROM Flight f
            INNER JOIN FlightRoute fr ON f.flight_number = fr.flight_number
            INNER JOIN Airport da ON fr.departure_airport = da.iata_code
            INNER JOIN Airport aa ON fr.arrival_airport = aa.iata_code
            WHERE fr.departure_airport = ? 
              AND fr.arrival_airport = ? 
              AND DATE(f.departure_time) = ?
        ");
        $stmt1->execute([$departureAirportId, $arrivalAirportId, $departureDate]);
        $outboundFlights = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        // جلب رحلات العودة
        $stmt2 = $this->db->prepare("
            SELECT f.*, fr.departure_airport, fr.arrival_airport,
                   da.airport_name AS departure_airport_name,
                   aa.airport_name AS arrival_airport_name
            FROM Flight f
            INNER JOIN FlightRoute fr ON f.flight_number = fr.flight_number
            INNER JOIN Airport da ON fr.departure_airport = da.iata_code
            INNER JOIN Airport aa ON fr.arrival_airport = aa.iata_code
            WHERE fr.departure_airport = ? 
              AND fr.arrival_airport = ? 
              AND DATE(f.departure_time) = ?
        ");
        $stmt2->execute([$arrivalAirportId, $departureAirportId, $returnDate]);
        $returnFlights = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        return [
            'outbound' => $outboundFlights,
            'return' => $returnFlights
        ];
    }

}

?>


