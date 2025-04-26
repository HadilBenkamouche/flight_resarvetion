
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
<div class="container">
    <div class="confirmation-card">
        <h1>Reservation Confirmed</h1>

        <p>Thank you for booking with us!</p>
        <p>Your reservation has been successfully processed.</p>

        <!-- Reservation Summary -->
        <div class="details">
            <p><strong>Passenger:</strong> John Doe</p>
            <p><strong>Email:</strong> johndoe@email.com</p>
            <p><strong>Phone Number:</strong> +123 456 7890</p>
        </div>

        <!-- Flight Information -->
        <div class="flight-info">
            <p><strong>Flight Number:</strong> PLT123</p>
            <p><strong>Destination:</strong> Mars International Airport</p>
            <p><strong>Departure Date:</strong> 2025-05-01 10:00</p>
            <p><strong>Class:</strong> Business</p>
            <p><strong>Payment Method:</strong> Visa</p>
        </div>

        <!-- Back Button -->
        <a href="book-a-flight.html" class="btn-back">Back to Booking</a>
    </div>
</div>

</body>
</html>