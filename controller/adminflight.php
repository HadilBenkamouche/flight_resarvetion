<?php
require_once '../Model/flightadmin.php';
require_once '../confi/db.php'; 



$model = new AdminModel($pdo);

$companies = $model->getAllCompanies();
$aircraft = $model->getAllAircraft();
$airports = $model->getAllAirports();

// تمرير النتائج إلى الواجهة
include '../View/flights/addflight.php';
?>