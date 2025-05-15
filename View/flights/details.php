

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Details - Nova Travels</title>
    <style>
        :root {
            --cherry-red: #b22234;
            --off-white: #ffffff;
        }

        body {
            background-color: var(--off-white);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar CSS */
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

        /* Styling for content */
        .container {
            padding: 2rem;
            margin-top: 100px; /* Adjusted to prevent overlap with navbar */
        }

        .details-card {
            border: 3px solid var(--cherry-red);
            padding: 2rem;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .details-card h1 {
            color: var(--cherry-red);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .details-card p {
            font-size: 1.1rem;
            margin: 10px 0;
            font-weight: bold;
        }

        .btn-back, .btn-book {
            margin-top: 20px;
            display: inline-block;
            background-color: var(--cherry-red);
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.95rem;
        }

        .btn-back:hover, .btn-book:hover {
            background-color: #a01d1d;
        }

        .btn-book {
            margin-left: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar Section -->
<header>
    <nav class="navbar">
        <img src="logo.png" alt="Logo" class="logo">
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
        <div class="nav-links">
            <a href="localhost/flight_resarvetion/" class="nav-link">Home</a>
            <a href="index.html#booking" class="nav-link">Book a Flight</a>
            <a href="reservations.html" class="nav-link">Reservations</a>
            
        </div>
        <div class="auth-buttons">
            <button class="login-btn">Login</button>
            <button class="signup-btn">Sign Up</button>
        </div>
    </nav>
</header>
<!-- Main Content Section -->
<!-- Main Content Section -->
<div class="container">
    <?php if (!empty($flightDetails)): ?>
        <div class="details-card">
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

            <!-- عدد المقاعد المتبقية لكل كلاس -->
            <p><strong>First Class Seats Left:</strong> <?php echo $flightDetails['remaining_first_seats']; ?></p>
            <p><strong>Business Class Seats Left:</strong> <?php echo $flightDetails['remaining_business_seats']; ?></p>
            <p><strong>Economy Class Seats Left:</strong> <?php echo $flightDetails['remaining_economy_seats']; ?></p>
        </div> <!-- إغلاق details-card -->
    <?php endif; ?>

    <!-- Buttons -->
    <a href="details.php" class="btn-back">Back to Flights</a>

    <a href="/flight_resarvetion/View/resarvetion/booking.php?flight_number=<?php echo urlencode($flightNumber); ?>" class="btn-book">Book This Flight</a>

</div> <!-- إغلاق container -->

</body>
</html>




   


