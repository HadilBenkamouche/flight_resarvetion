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
  <title>Payment - Nova Travel</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@900&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    body {
      margin: 0;
      background-color: #fdf9f6;
    }

    /* New Navbar Styling */
    .navbar {
      display: flex;
      align-items: center;
      justify-content: flex-start;
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
      margin-right: 140px;
      margin-bottom: 1mm;
    }

    .search-bar input {
      margin-left: 1px;
      padding: 10px 20px;
      border-radius: 25px;
      border: 1.4px solid #B22234;
      width: 300px;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .search-bar input:focus {
      outline: none;
      border-color: #B22234;
      box-shadow: 0 0 5px #7d010b;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 30px;
      margin-left: 40px;
    }

    .nav-link {
      text-decoration: none;
      color: #B22234;
      font-weight: bold;
      font-size: 16px;
      position: relative;
      padding-bottom: 5px;
      transition: all 0.3s ease;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0%;
      height: 2px;
      background-color: #B22234;
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .nav-link:hover {
      color: #7d010b;
    }

    .auth-buttons {
      display: flex;
      gap: 15px;
      margin-left: auto;
      padding-right: 20px;
    }

    .login-btn,
    .signup-btn {
      background-color: #B22234;
      color: #ffffff;
      border: none;
      border-radius: 25px;
      padding: 10px 20px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-btn:hover,
    .signup-btn:hover {
      background-color: #7d010b;
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    /* Payment Form Styling */
    .container {
      max-width: 500px;
      margin: 140px auto;
      background: #ffffff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #B22234;
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border-radius: 8px;
      border: 1px solid #ccc;
      transition: 0.3s ease;
    }

    input:focus {
      outline: none;
      border-color: #B22234;
      box-shadow: 0 0 6px rgba(178, 34, 52, 0.3);
    }

    .btn-pay {
      margin-top: 25px;
      background-color: #B22234;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 12px;
      font-weight: bold;
      font-size: 16px;
      width: 100%;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-pay:hover {
      background-color: #7d010b;
    }
  </style>
</head>
<body>

  <!-- Replaced Navbar -->
  <div class="navbar">
  <img src="\flight_resarvetion\Logo.png" alt="Logo" class="logo">
    <div class="search-bar">
      <input type="text" placeholder="Search">
    </div>
    <div class="nav-links">
      <a href="index.html" class="nav-link">Home</a>
      <a href="flights.html" class="nav-link">Flights</a>
      <a href="contact.html" class="nav-link">Contact Us</a>
    </div>
    <div class="auth-buttons">
      <button class="login-btn">Login</button>
      <button class="signup-btn">Sign Up</button>
    </div>
  </div>

  <!-- Payment Form -->
  <div class="container">
    <h1>Payment</h1>
    <form action="../../controller/resarvetion.php" method="POST">
    <input type="hidden" name="action" value="addPayment">
    
    <label for="cardholder">Cardholder Name</label>
    <input type="text" id="cardholder" name="card_name" required>

    <label for="card-number">Card Number</label>
    <input type="text" id="card-number" name="card_number" maxlength="16" required>

    <label for="expiry">Expiry Date</label>
    <input type="text" id="expiry" name="expiry_date" placeholder="MM/YY" required>

    <label for="cvv">CVV</label>
    <input type="text" id="cvv" name="cvv" maxlength="4" required>

    <button type="submit" class="btn-pay">Confirm Payment</button>
</form>


</div>


</body>
</html>