<?php
session_start();

if (!isset($_SESSION['confirmation_details'])) {
    header("Location: booking.php");
    exit;
}

$details = $_SESSION['confirmation_details'];
$reservation = $details['reservation'];
$passengers = $details['passengers'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reservation Confirmed - Nova Travels</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('http://localhost/flight_resarvetion/View/resarvetion/back.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 100px;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      background: #fff;
      height: 80px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      z-index: 1000;
    }

    .logo {
     padding-top: 15px;
      width: 170px;
      height: auto;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .nav-items {
      display: flex;
      gap: 30px;
    }

    .nav-items a {
      font-weight: bold;
      font-size: 16px;
      color: #B22234;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .nav-items a:hover {
      color: #7d010b;
      transform: scale(1.05);
    }

    .logout-button {
      background-color: #B22234;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 50px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
       margin-right: 40px; 
    }

    .logout-button:hover {
      background-color: #7d010b;
    }

    .glass-box {
      background: #ffffffdd;
      border-radius: 20px;
      padding: 30px;
      width: 750px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.25);
      border: 2px solid white;
      text-align: center;
       margin-bottom: 20px;
    }

    .glass-box h2 {
      color: #B22234;
      margin-bottom: 10px;
    }

    .glass-box img {
      width: 150px;
      margin-bottom: -40px;
      margin-top: -40px;
    }

    .section {
      text-align: left;
      margin-top: 30px;
    }

    .section h3 {
      color: #B22234;
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
      margin-bottom: 15px;
    }

    .info-row {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
    }

    .info-label {
      font-weight: bold;
    }

    .success-icon {
      font-size: 50px;
      color: #28a745;
      margin-bottom: 20px;
    }
    .code-box {
      background-color: #B22234;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 18px;
      font-weight: bold;
      margin-top: 30px;
      display: inline-block;
    }

    @media (max-width: 850px) {
      .glass-box {
        width: 95%;
        padding: 25px;
      }

      .nav-items {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

<div class="navbar">
  <img src="\flight_resarvetion\Logo.png" alt="Logo" class="logo">
  <div class="nav-links">
    <div class="nav-items">
      <a href="http://localhost/flight_resarvetion/index.php">Home</a>
      <a href="http://localhost/flight_resarvetion/controller/flight.php?action=List">Flights</a>
      <a href="../../reservations.html">Contact Us</a>
    </div>
    <button class="logout-button" onclick="location.href='/flight_resarvetion/controller/logoutController.php'">Log Out</button>
  </div>
</div>

<div class="glass-box">
   <div class="success-icon">✔️</div>
  <h2>Your Reservation is Confirmed!</h2>
  <p>Thank you for choosing Nova Travels.</p>

  <div class="section">
    <h3>Flight Details</h3>
    <div class="info-row"><span class="info-label">From:</span><span><?=htmlspecialchars($reservation['departure_airport']) ?></span></div>
    <div class="info-row"><span class="info-label">To:</span><span><?= htmlspecialchars($reservation['arrival_airport']) ?></span></div>
    <div class="info-row"><span class="info-label">Date:</span><span><?= date('F j, Y', strtotime($reservation['departure_time'])) ?></span></div>
    <div class="info-row"><span class="info-label">Class:</span><span><?= htmlspecialchars($reservation['class_name']) ?></span></div>
  <div class="info-row"><div class="info-label">Total Price:</div><div><?= number_format($reservation['total_price'], 2) ?> DZA</div></div>
  </div>

  <div class="section">
    <h3>Passenger Info</h3>
    <?php foreach ($passengers as $index => $passenger): ?>
      <div class="info-row"><span class="info-label">Name:</span><span><?= htmlspecialchars($passenger['first_name'] . ' ' . $passenger['last_name']) ?></span></div>
      <div class="info-row"><span class="info-label">Email:</span><span><?= htmlspecialchars($passenger['email']) ?></span></div>
      <div class="info-row"><span class="info-label">Phone:</span><span><?= htmlspecialchars($passenger['phone']) ?></span></div>
      <?php if ($index < count($passengers) - 1): ?><hr><?php endif; ?>
    <?php endforeach; ?>
  </div>

  <div class="code-box">
    Reservation Code: <?= htmlspecialchars($reservation['reservation_number']) ?>
  </div>
</div>

</body>
</html>