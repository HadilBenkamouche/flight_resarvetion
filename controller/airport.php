<?php
require_once __DIR__ . '/../confi/db.php';
require_once __DIR__ . '/../Model/airport.php';

$airportModel = new Airport($pdo);
$airports = $airportModel->getAllAirportsWithCities();

// إرسال البيانات إلى الواجهة
include __DIR__ . '/../index.php';
