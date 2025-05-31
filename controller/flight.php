<?php

require_once '../Model/flight.php';
require_once '../confi/db.php'; // التأكد من الاتصال بقاعدة البيانات

$flight = new Flight($pdo);

$action = $_GET['action'] ?? 'List';

if ($action == 'List') {
    // جلب جميع الرحلات
    $flights = $flight->getAllFlights();
    require_once '../View/flights/List.php';

} elseif ($action == 'details' && isset($_GET['flight_number'])) {
    // جلب تفاصيل الرحلة باستخدام رقم الرحلة
    $flightNumber = $_GET['flight_number'];
    $flightDetails = $flight->getFlightByNumber($flightNumber);

    if ($flightDetails) {
        require_once '../View/flights/details.php';
    } else {
        echo "الرحلة غير موجودة.";
    }

} 

if ($action == 'search' && isset($_GET['from'], $_GET['to'], $_GET['departure_date'])) {
    $fromAirportCode = $_GET['from']; // رمز المطار المغادر
    $toAirportCode = $_GET['to'];     // رمز المطار الواصل
    $departureDate = $_GET['departure_date'];
    $returnDate = $_GET['return_date'] ?? null; // تاريخ العودة (قد لا يكون موجودًا)
    $tripType = $_GET['trip_type'] ?? 'oneway';

    // تحديد نوع الرحلة
    if ($tripType === 'oneway') {
        $tripType = 'One Way';
    } elseif ($tripType === 'roundtrip') {
        $tripType = 'Round Trip';
    }

    $adults = isset($_GET['adults']) ? (int)$_GET['adults'] : 1;
    $children = isset($_GET['children']) ? (int)$_GET['children'] : 0;
    $infants = isset($_GET['infants']) ? (int)$_GET['infants'] : 0;
    $passengers = $adults + $children + $infants;

    // تنفيذ البحث حسب نوع الرحلة
    if ($tripType === 'Round Trip' && !empty($returnDate)) {
        $flights = $flight->searchRoundTripFlights($fromAirportCode, $toAirportCode, $departureDate, $returnDate);
         $outboundFlights = $flights['outbound'];
          $returnFlights = $flights['return'];
        require_once '../View/flights/ListRT.php';
    } else {
        $flights = $flight->searchFlights($fromAirportCode, $toAirportCode, $departureDate, $tripType, $passengers);
        require_once '../View/flights/List.php';
    }
}


elseif ($action == 'details' && isset($_GET['flight_number'])) {
    // جلب تفاصيل الرحلة باستخدام رقم الرحلة
    $flightNumber = $_GET['flight_number'];
    $flightDetails = $flight->getFlightByNumber($flightNumber);

    if ($flightDetails) {
        require_once '../View/flights/details.php';
    } else {
        echo "الرحلة غير موجودة.";
    }
}
if ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $flightNumber     = $_POST['flightNumber'];
    $flightType       = $_POST['flightType'];
    $companyCode      = $_POST['companyCode'];
    $aircraftCode     = $_POST['aircraftCode'];
    $departureAirport = $_POST['departureAirport'];  // فقط لـ flightrout
    $arrivalAirport   = $_POST['arrivalAirport'];    // فقط لـ flightrout
    $departure        = $_POST['departure'];
    $arrival          = $_POST['arrival'];
    $destination      = $_POST['destination'];
    $firstPrice       = $_POST['firstClassPrice'];
    $businessPrice    = $_POST['businessClassPrice'];
    $economyPrice     = $_POST['economyClassPrice'];

    // إدخال بيانات الرحلة في جدول flight (دون المطارات)
    $result = $flight->addFlight(
        $flightNumber, $flightType, $companyCode, $aircraftCode,
        $departure, $arrival, $destination,
        $firstPrice, $businessPrice, $economyPrice
    );

    if ($result) {
        // ثم إدخال بيانات المسار في جدول flightrout
        $stmt = $pdo->prepare("INSERT INTO flightroute (flight_number, departure_airport, arrival_airport)
                               VALUES (:flight_number, :departure_airport, :arrival_airport)");
        $stmt->bindParam(':flight_number', $flightNumber);
        $stmt->bindParam(':departure_airport', $departureAirport);
        $stmt->bindParam(':arrival_airport', $arrivalAirport);
        $stmt->execute();

        header("Location: ../View/flights/manageflight.php?success=1");
        exit;
    } else {
        echo "فشل في إضافة الرحلة.";
    }


  }
 
 //delete flight...
 
  if ($action == 'delete' && isset($_GET['flight_number'])) {
    $flightNumber = $_GET['flight_number'];
    $success = $flight->deleteFlight($flightNumber);

    if ($success) {
        header("Location: ../View/flights/manageflight.php?message=Flight+deleted+successfully");
        exit();
    } else {
        header("Location: ../View/flights/manageflight.php?error=Failed+to+delete+flight");
        exit();
    }
}


?>














