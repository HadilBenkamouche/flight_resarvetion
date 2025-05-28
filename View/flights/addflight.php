<?php
require_once '../../Model/flightadmin.php';
require_once '../../confi/db.php'; 
$model = new AdminModel($pdo);

$companies = $model->getAllCompanies();
$aircraft = $model->getAllAircraft();
$airports = $model->getAllAirports();
$cities = $model->getAllCities();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Flight - Admin Dashboard</title>
  <style>
    :root {
      --cherry-red: #b22234;
      --off-white: #ffffff;
    }

    * {
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: var(--off-white);
      padding-top: 100px;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 40px;
      background-color: #ffffff;
      height: 80px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    .logo {
      padding-top: 15px;
      width: 170px;
      height: auto;
    }

    .logout-btn {
      background-color: var(--cherry-red);
      color: #ffffff;
      border: none;
      border-radius: 25px;
      padding: 10px 20px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #7d010b;
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    main {
      max-width: 900px;
      margin: auto;
      padding: 30px 20px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.08);
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    .section-title {
      font-size: 18px;
      font-weight: bold;
      margin: 30px 0 15px;
      color: var(--cherry-red);
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
    }

    .grid-form {
      display: flex;
      flex-direction: column;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #444;
    }

    input[type="text"],
    input[type="datetime-local"],
    select {
      width: 100%;
      padding: 12px 14px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }

    input:focus,
    select:focus {
      border-color: var(--cherry-red);
      outline: none;
    }

    .btn-container {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .btn {
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .btn-cancel {
      background-color: #999;
    }

    .btn-cancel:hover {
      background-color: #666;
    }

    .btn-save {
      background-color: var(--cherry-red);
    }

    .btn-save:hover {
      background-color: #7d010b;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <img src="your-logo.png" alt="Logo" class="logo">
    <button class="logout-btn">Logout</button>
  </div>

 <main>
  <h1>Add New Flight</h1>
  <form class="grid-form" action="../../controller/flight.php?action=add" method="POST">
    <h2 class="section-title">Flight Information</h2>
    <div class="form-grid">
      <div>
        <label for="flightNumber">Flight Number</label>
        <input type="text" id="flightNumber" name="flightNumber" required>
      </div>

      <div>
        <label for="flightType">Flight Type</label>
        <select id="flightType" name="flightType" required>
          <option value="" disabled selected>Select flight type</option>
          <option value="One Way">One Way</option>
          <option value="Round Trip">Round Trip</option>
        </select>
      </div>

      <div>
        <label for="companyCode">Company</label>
        <select id="companyCode" name="companyCode" required>
          <option value="" disabled selected>Select a company</option>
          <?php foreach ($companies as $company): ?>
            <option value="<?= $company['company_code'] ?>">
              <?= $company['NAME'] ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label for="aircraftCode">Aircraft</label>
        <select id="aircraftCode" name="aircraftCode" required>
          <option value="" disabled selected>Select an aircraft</option>
          <?php foreach ($aircraft as $aircraft): ?>
            <option value="<?= $aircraft['aircraft_code'] ?>">
              <?= $aircraft['model'] ?> (<?= $aircraft['capacity'] ?> seats)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label for="capacity">Capacity</label>
        <input type="number" id="capacity" name="capacity" required>
      </div>
    </div>

    <h2 class="section-title">Airports & Schedule</h2>
    <div class="form-grid">
      <div>
        <label for="departureAirport">Departure Airport</label>
        <select id="departureAirport" name="departureAirport" required>
          <option value="" disabled selected>Select departure airport</option>
          <?php foreach ($airports as $airport): ?>
            <option value="<?= $airport['iata_code'] ?>">
              <?= $airport['airport_name'] ?> (<?= $airport['iata_code'] ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label for="arrivalAirport">Arrival Airport</label>
        <select id="arrivalAirport" name="arrivalAirport" required>
          <option value="" disabled selected>Select arrival airport</option>
          <?php foreach ($airports as $airport): ?>
            <option value="<?= $airport['iata_code'] ?>">
              <?= $airport['airport_name'] ?> (<?= $airport['iata_code'] ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label for="departure">Departure Time</label>
        <input type="datetime-local" id="departure" name="departure" required>
      </div>

      <div>
        <label for="arrival">Arrival Time</label>
        <input type="datetime-local" id="arrival" name="arrival" required>
      </div>
    </div>
<div>
  <label for="destination">Destination</label>
  <select id="destination" name="destination" required>
    <option value="" disabled selected>Select destination city</option>
    <?php foreach ($cities as $city): ?>
      <option value="<?= $city['NAME'] ?>">
        <?= $city['NAME'] ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>
    <h2 class="section-title">Pricing</h2>
    <div class="form-grid">
      <div>
        <label for="firstClassPrice">First Class Price</label>
        <input type="text" id="firstClassPrice" name="firstClassPrice" required>
      </div>
      <div>
        <label for="businessClassPrice">Business Class Price</label>
        <input type="text" id="businessClassPrice" name="businessClassPrice" required>
      </div>
      <div>
        <label for="economyClassPrice">Economy Class Price</label>
        <input type="text" id="economyClassPrice" name="economyClassPrice" required>
      </div>
    </div>
<div class="btn-container">
      <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
      <button type="submit" class="btn btn-save">Add Flight</button>
    </div>
  </form>
</main>
</body>
</html>