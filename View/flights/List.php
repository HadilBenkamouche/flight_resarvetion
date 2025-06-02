<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nova Travel - Available Flights</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      background: url('http://localhost/flight_resarvetion/View/flights/back.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      padding-top: 100px;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 40px;
      background-color: white;
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

    .nav-section {
      display: flex;
      align-items: center;
      gap: 40px;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .nav-links a {
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
      position: relative;
      transition: all 0.3s ease;
      padding: 8px 12px;
      border-radius: 6px;
      color: #B22234;
    }

    .nav-links a::after {
      content: "";
      position: absolute;
      width: 0%;
      height: 2px;
      bottom: -5px;
      left: 0;
      background-color: #B22234;
      transition: width 0.3s ease;
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    .nav-links a:hover {
      transform: scale(1.05);
      color: #7d010b;
    }

    .auth-buttons {
      display: flex;
      gap: 15px;
    }

    .auth-btn {
      background-color: #B22234;
      color: white;
      border: none;
      border-radius: 50px;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .auth-btn:hover {
      background-color: #7d010b;
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 2.5rem;
      color: rgb(255, 255, 255);
      text-align: center;
      text-shadow: 1px 1px 4px #000;
      margin-bottom: 40px;
    }

    .flight-list {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 30px;
      padding: 40px 20px;
    }

    .flight-card {
      background: #ffffffdd;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      text-align: left;
      width: 300px;
      transition: transform 0.3s ease;
    }

    .flight-card:hover {
      transform: translateY(-5px);
    }

    .flight-card h3 {
      color: #000;
      font-size: 1.2rem;
      margin-bottom: 10px;
    }

    .flight-card p {
      margin: 8px 0;
      color: #000000;
      font-size: 0.95rem;
    }

    .btn-details {
      display: inline-block;
      margin-top: 15px;
      background-color: #B22234;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      font-size: 1rem;
      font-weight: bold;
      text-decoration: none;
      transition: background 0.3s ease;
    }

    .btn-details:hover {
      background-color: #7d010b;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <img src="http://localhost/flight_resarvetion/View/flights/Logo.png" alt="Nova Travel Logo" class="logo">

    <div class="nav-section">
      <div class="nav-links">
        <a href="http://localhost/flight_resarvetion/index.php">Home</a>
        <a href="http://localhost/flight_resarvetion/controller/flight.php?action=List">Flights</a>
        <a href="reservation.html">Contact Us</a>
      </div>
      <div class="auth-buttons">
        <a href="http://localhost/flight_resarvetion/View/client/login.php" class="auth-btn">Login</a>
        <a href="http://localhost/flight_resarvetion/View/client/signup.php"
        class="auth-btn">Sign Up</a>
      </div>
    </div>
  </div>

  <main>
    <h1>Available Flights</h1>

    <div class="flight-list">
      <?php if (!empty($flights)): ?>
        <?php foreach ($flights as $flight): ?>
          <div class="flight-card">
            <h3>Flight Number: <?php echo htmlspecialchars($flight['flight_number']); ?></h3>
            <p>From: <?php echo htmlspecialchars($flight['departure_city']); ?></p>
            <p>To: <?php echo htmlspecialchars($flight['arrival_city']); ?></p>
            <p>Departure: <?php echo htmlspecialchars($flight['departure_time']); ?></p>
            <p>Arrival: <?php echo htmlspecialchars($flight['arrival_time']); ?></p>
            <a href="flight.php?action=details&flight_number=<?php echo urlencode($flight['flight_number']); ?>" class="btn-details">View Details</a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="text-align:center; color:white;">No flights found matching your criteria.</p>
      <?php endif; ?>
    </div>
  </main>

</body>
</html>





