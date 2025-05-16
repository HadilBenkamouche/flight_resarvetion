
<pre><?php var_dump($details); ?></pre>
<?php
session_start();
$details = $_SESSION['confirmation_details'] ?? [];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmed</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ffffff;
            padding: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

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

        .container {
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
            padding-top: 100px; /* Adjust for fixed navbar */
        }

        .confirmation-card {
            border: 3px solid #990000;
            padding: 40px;
            border-radius: 10px;
            background-color: #ffe6e6;
            text-align: center;
        }

        .confirmation-card h1 {
            color: #990000;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .confirmation-card p {
            font-size: 18px;
            margin: 10px 0;
        }

        .confirmation-card .details {
            font-weight: bold;
            color: #990000;
        }

        .confirmation-card .flight-info {
            margin-top: 30px;
            border-top: 2px solid #990000;
            padding-top: 20px;
        }

        .confirmation-card .flight-info p {
            font-size: 16px;
            margin: 10px 0;
        }

        .btn-back {
            background-color: #990000;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: #660000;
        }
    </style>
</head>
<body>

<!-- New Navbar -->
<header>
    <nav class="navbar">
        <img src="logo.png" alt="Logo" class="logo">
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
        <div class="nav-links">
            <a href="homepage.html" class="nav-link">Home</a>
            <a href="reservation.html" class="nav-link">Book a Flight</a>
            <a href="reservations.html" class="nav-link">Reservations</a>
            <a href="logout.html" class="nav-link">Log Out</a>
        </div>
        <div class="auth-buttons">
            <button class="login-btn">Login</button>
            <button class="signup-btn">Sign Up</button>
        </div>
    </nav>
</header>

<!-- Main Content -->
<div class="confirmation-container">
    <div class="confirmation-box">
        <div class="success-icon">✔️</div>
        <h2>Your Reservation is Confirmed!</h2>
        <p>Thank you for choosing Nova Travels.</p>

        <?php if (!empty($details)): 
            $flight = $details[0]; 
        ?>
        <div class="summary-section">
            <h3>Flight Details</h3>
            <div class="info-row"><div class="info-label">From:</div><div><?= htmlspecialchars($flight['departure_city']) ?></div></div>
            <div class="info-row"><div class="info-label">To:</div><div><?= htmlspecialchars($flight['arrival_city']) ?></div></div>
            <div class="info-row"><div class="info-label">Date:</div><div><?= htmlspecialchars($flight['reservation_date']) ?></div></div>
            <div class="info-row"><div class="info-label">Class:</div><div><?= htmlspecialchars($flight['class_name']) ?></div></div>
        </div>

        <div class="summary-section">
            <h3>Passenger Info</h3>
            <?php foreach ($details as $passenger): ?>
            <div class="info-row"><div class="info-label">Name:</div><div><?= htmlspecialchars($passenger['first_name'] . ' ' . $passenger['last_name']) ?></div></div>
            <div class="info-row"><div class="info-label">Email:</div><div><?= htmlspecialchars($passenger['email']) ?></div></div>
            <hr>
            <?php endforeach; ?>
        </div>

        <div class="reservation-code">Reservation Code: <?= htmlspecialchars($flight['reservation_number']) ?></div>
        <?php else: ?>
        <p>لا توجد معلومات حجز متاحة.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>