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

    /* New Navbar Styling */
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
      gap: 40px;
    }
   

   .nav-links {
      display: flex;
      align-items: center;
      gap: 30px;
       margin-left: 493px;
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

    /* Payment Form Styling */
     .glass-box {
      width: 100%;
      max-width: 600px;
      background: #ffffffdd;;
      border-radius: 20px;
      border: 2px solid white;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      padding: 40px;
      margin: 20px auto;
      text-align: left;
    }
    .glass-box h2 {
      margin-bottom: 30px;
      font-size: 2.4rem;
      color: #B22234;
      text-align: center;
    }

    label {
      display: block;
      font-weight: bold;
      margin: 15px 0 5px;
      color: #000;
    }

    input {
      width: 100%;
      padding: 12px;
      font-size: 1rem;
      border-radius: 10px;
      border: 1px solid #c3c3c3;
      background-color: #fff;
    }
 input:focus {
      border: 1px solid #B22234;
      outline: none;
      box-shadow: 0 0 5px #B22234;
    }

    .btn-book {
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
      margin-top: 20px;
    }

    .btn-book:hover {
      background-color: #7d010b;
      transform: scale(1.03);
      box-shadow: 0 4px 8px #00000055;
    }
  </style>
</head>
<body>
<!-- Replaced Navbar -->
  <div class="navbar">
  <img src="\flight_resarvetion\Logo.png" alt="Logo" class="logo">
   <div class="nav-container"></div>
    <div class="nav-links">
      <a href="http://localhost/flight_resarvetion/index.php" class="nav-link">Home</a>
      <a href="http://localhost/flight_resarvetion/controller/flight.php?action=List" class="nav-link">Flights</a>
      <a href="contact.html" class="nav-link">Contact Us</a>
    </div>
    <div class="auth-buttons">
      <a href="http://localhost/flight_resarvetion/View/client/login.php" class="auth-btn">Login</a>
        <a href="http://localhost/flight_resarvetion/View/client/signup.php" class="auth-btn">Sign Up</a>
      </div>
    </div>
  </div>

  <!-- Payment Form -->
   <div class="glass-box">
    <h2>Payment</h2>
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

    <button type="submit" class="btn-book">Confirm Payment</button>
</form>


</div>


</body>
</html>