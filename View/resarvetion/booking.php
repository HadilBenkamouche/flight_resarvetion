<?php
// تأكد من بدء الجلسة بشكل آمن
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nova Travel - Booking Confirmation</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: url('http://localhost/flight_resarvetion/View/resarvetion/back.jpg') no-repeat center center fixed;
      background-size: cover;
      padding-top: 80px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
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
      justify-content: space-between;
    }

    .logo {
      padding-top: 15px;
      width: 170px;
      height: auto;
    }

    .nav-container {
      display: flex;
      align-items: center;
      gap: 30px;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 30px;
    }

    .nav-links a {
      color: #B22234;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
      position: relative;
      transition: all 0.3s ease;
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

    .glass-box {
     width: 830px;
      margin: 30px auto 10px;
      padding: 40px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      text-align: left;
    }

    .glass-box h2 {
      margin-bottom: 30px;
      font-size: 2.4rem;
      color: #B22234;
      text-align: center;
    }

    .passenger-form {
      margin-bottom: 30px;
    }

    .passenger-form h3 {
      color: #111;
      margin-bottom: 10px;
    }

    label {
      display: block;
      font-weight: bold;
      margin: 15px 0 5px;
      color: #000;
    }

    input, select {
      width: 100%;
      padding: 12px;
      font-size: 1rem;
      border-radius: 10px;
      border: 1px solid #c3c3c3;
      background-color: #fff;
    }

    input:focus, select:focus {
      border: 1px solid #B22234;
      outline: none;
      box-shadow: 0 0 5px #B22234;
    }

    .payment-methods {
      display: flex;
      justify-content: space-around;
      margin: 20px 0;
    }

    .btn-add, .btn-book {
      display: block;
      width: 100%;
      padding: 15px;
      border-radius: 10px;
      font-weight: bold;
      font-size: 1.1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      background-color: #B22234;
      color: white;
      border: none;
      margin-top: 10px;
    }

    .btn-add:hover, .btn-book:hover {
      background-color: #7d010b;
      transform: scale(1.03);
      box-shadow: 0 4px 8px #00000055;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <img src="\flight_resarvetion\Logo.png" alt="Nova Travel Logo" class="logo">
    <div class="nav-container">
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

  <!-- Glass Box -->
  <div class="glass-box">
    <h2>Book a Flight</h2>
      <form id="reservation-form" action="../../controller/resarvetion.php" method="POST">
      <input type="hidden" name="action" value="addReservation">
      <div id="passenger-forms">
        <div class="passenger-form">
          <h3>Passenger 1</h3>

          <label for="first-name">First Name:</label>
          <input type="text" id="first-name" name="first_name[]" required>

          <label for="last-name">Last Name:</label>
          <input type="text" id="last-name" name="last_name[]" required>

          <label for="email-1">Email:</label>
          <input type="email" id="email-1" name="email[]" required>

          <label for="phone">Phone Number:</label>
          <input type="tel" id="phone" name="phone[]" required>

          <label for="flight-number">Flight Number:</label>
            <input type="text" id="flight-number" name="flight_number" value="<?php echo isset($_GET['flight_number']) ? htmlspecialchars($_GET['flight_number']) : ''; ?>" readonly>

          

          <label for="flight-class">Class:</label>
            <select id="flight-class" name="class_name" required>

                <option value="Economy">Economy</option>
                <option value="Business">Business</option>
                <option value="First Class">First Class</option>
            </select>

          <label>Payment Method:</label>
          <div class="payment-methods">
            <div>
              <input type="radio" id="visa" name="payment_method" value="Visa" required>
              <label for="visa">Visa</label>
            </div>
            <div>
              <input type="radio" id="mastercard" name="payment_method" value="Mastercard">
              <label for="mastercard">Mastercard</label>
            </div>
            <div>
              <input type="radio" id="post" name="payment_method" value="Algérie Poste">
              <label for="post">Algérie Poste</label>
            </div>
          </div>
        </div>
      </div>

      <button type="button" class="btn-add" onclick="addPassengerForm()">Add Reservation</button>
      <button type="submit" class="btn-book">Confirm Reservation</button>
    </form>
  </div>

  <script>
    let passengerCount = 1;

    function addPassengerForm() {
      passengerCount++;
      const container = document.getElementById('passenger-forms');
      const newForm = document.createElement('div');
      newForm.classList.add('passenger-form');
      newForm.innerHTML = `
        <h3>Passenger ${passengerCount}</h3>
        <label>First Name:</label>
        <input type="text" name="first_name[]" required>

        <label>Last Name:</label>
        <input type="text" name="last_name[]" required>

        <label>Email:</label>
        <input type="email" name="email[]" required>

        <label>Phone Number:</label>
        <input type="tel" name="phone[]" required>
      `;
      container.appendChild(newForm);
    }
  </script>

</body>
</html>