<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nova Travel - Flight Details</title>
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
      display: flex;
      justify-content: center;
      align-items: flex-start;
      flex-direction: column;
    }

    .navbar {
      display: flex;
      align-items: center;
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
    }

    .right-nav {
      display: flex;
      align-items: center;
      gap: 30px;
      margin-left: auto;
    }

    .nav-links {
      display: flex;
      gap: 25px;
    }

    .nav-links a {
      color: #B22234;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
      position: relative;
      transition: 0.3s ease;
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

    .auth-buttons {
      display: flex;
      gap: 15px;
    }

    .auth-btn {
      background-color: #B22234;
      color: white;
      border: none;
      border-radius: 25px;
      padding: 10px 20px;
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

    .glass-box {
      width: 830px;
      margin: -1px auto 10px;
      padding: 40px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      text-align: left;
    }

    .glass-box h1 {
      color: #B22234;
      font-size: 2rem;
      margin-bottom: 20px;
    }

    .glass-box p {
      margin-bottom: 10px;
      font-size: 1.1rem;
    }

    .button-container {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 25px;
    }

    .btn-back, .btn-book {
      background-color: #B22234;
      color: #fff;
      padding: 12px 25px;
      border-radius: 25px;
      font-weight: bold;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .btn-back:hover, .btn-book:hover {
      background-color: #7d010b;
      transform: scale(1.05);
    }

    @media (max-width: 850px) {
      .glass-box {
        margin: 130px 20px 20px;
        padding: 25px;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <img src="http://localhost/flight_resarvetion/View/flights/Logo.png" alt="Nova Travel Logo" class="logo">

    <div class="right-nav">
      <div class="nav-links">
        <a href="http://localhost/flight_resarvetion/index.php">Home</a>
        <a href="http://localhost/flight_resarvetion/controller/flight.php?action=List">Flights</a>
        <a href="reservation.html">Contact Us</a>
      </div>

      <div class="auth-buttons">
        <a href="http://localhost/flight_resarvetion/View/client/login.php" class="auth-btn">Login</a>
        <a href="http://localhost/flight_resarvetion/View/client/signup.php" class="auth-btn">Sign Up</a>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="glass-box">
    <h1>Flight <?php echo htmlspecialchars($flightDetails['flight_number']); ?> - <?php echo htmlspecialchars($flightDetails['company_name']); ?></h1>

     <p><strong>Flight Number:</strong> <?php echo htmlspecialchars($flightDetails['flight_number']); ?></p>
    <p><strong>Company:</strong> <?php echo htmlspecialchars($flightDetails['company_name']); ?></p>
    <p><strong>Destination:</strong> <?php echo htmlspecialchars($flightDetails['destination_airport_name']); ?></p>
    <p><strong>Departure Time:</strong> <?php echo htmlspecialchars($flightDetails['departure_time']); ?></p>
    <p><strong>Arrival Time:</strong> <?php echo htmlspecialchars($flightDetails['arrival_time']); ?></p>
    <p><strong>Flight Type:</strong> <?php echo htmlspecialchars($flightDetails['flight_type']); ?></p>
    <p><strong>Economy Price:</strong> <?php echo htmlspecialchars($flightDetails['economy_price']); ?> DA</p>
    <p><strong>Business Price:</strong> <?php echo htmlspecialchars($flightDetails['business_price']); ?> DA</p>
    <p><strong>First Class Price:</strong> <?php echo htmlspecialchars($flightDetails['first_class_price']); ?> DA</p>
    <p><strong>Aircraft:</strong> <?php echo htmlspecialchars($flightDetails['aircraft_model']); ?></p>
    <p><strong>First Class Seats Left:</strong> <?php echo $flightDetails['remaining_first_seats']; ?></p>
    <p><strong>Business Class Seats Left:</strong> <?php echo $flightDetails['remaining_business_seats']; ?></p>
    <p><strong>Economy Class Seats Left:</strong> <?php echo $flightDetails['remaining_economy_seats']; ?></p>

    <!-- Buttons -->
    <div class="button-container">
      <a href="http://localhost/flight_resarvetion/controller/flight.php?action=List" class="btn-back">Back to Flights</a>
      <a href="/flight_resarvetion/View/resarvetion/booking.php?flight_number=<?php echo urlencode($flightDetails['flight_number']); ?>" class="btn-book">Book This Flight</a>
    </div>
  </div>

</body>
</html>




   


