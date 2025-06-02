<?php
// Validate required data from the URL
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['reservation_number'])) {
    $reservationNumber = $_GET['reservation_number'];

    // Include database connection and model
    require_once '../../confi/db.php'; // Make sure this path is correct
    require_once '../../Model/reservtion.php'; // Check for correct spelling and filename

    $reservationModel = new Reservation($pdo); // Pass PDO instance to the class
    $reservation = $reservationModel->getReservationById($reservationNumber);

    if (!$reservation) {
        die("❌ Reservation not found.");
    }
} else {
    die("❌ Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Reservation</title>
  <style>
   
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

.nav-links {
  display: flex;
  align-items: center;
  gap: 30px;
}

.nav-link {
  text-decoration: none;
  color: #b22234;
  font-weight: bold;
  font-size: 16px;
  transition: color 0.3s ease;
}

.nav-link:hover {
  color: #7d010b;
}

   body {
      font-family: Arial, sans-serif;
      padding: 40px;
      background-color: #f5f5f5;
    }
    h2 {
      color: #b22234;
    }
    form {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      width: 400px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      font-weight: bold;
      display: block;
      margin: 15px 0 5px;
    }
    input, select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #b22234;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
 
 main {
  margin-top: 120px; /* لإزاحة المحتوى أسفل الـ navbar */
}

 </style>

</head>
<body>
<div class="navbar">
  <img src="\flight_resarvetion\Logo.png" alt="Logo" class="logo">
  <div class="nav-links">
    <a href="\flight_resarvetion\View\client\adminprofile.php" class="nav-link">Profile</a>
    <a href="\flight_resarvetion\controller\logoutController.php" class="nav-link">Logout</a>
  </div>
</div>
<main>
  <h2>Edit Reservation #<?= htmlspecialchars($reservation['reservation_number']) ?></h2>

  <form method="POST" action="\flight_resarvetion\controller\resarvetion.php">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="reservation_number" value="<?= htmlspecialchars($reservation['reservation_number']) ?>">

    <label for="flight_number">Flight Number</label>
    <input type="text" id="flight_number" name="flight_number" value="<?= htmlspecialchars($reservation['flight_number']) ?>" readonly>
    
    <label for="status">Status</label>
    <select name="status" id="status" required>
      <option value="Confirmed" <?= $reservation['STATUS'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
      <option value="Canceled" <?= $reservation['STATUS'] === 'Canceled' ? 'selected' : '' ?>>Canceled</option>
      <option value="Pending" <?= $reservation['STATUS'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
    </select>

    <label for="class">Travel Class</label>
    <select name="class" id="class" required>
      <option value="Economy" <?= $reservation['class_name'] === 'Economy' ? 'selected' : '' ?>>Economy</option>
      <option value="Business" <?= $reservation['class_name'] === 'Business' ? 'selected' : '' ?>>Business</option>
      <option value="First" <?= $reservation['class_name'] === 'First class' ? 'selected' : '' ?>>First class</option>
    </select>

    <button type="submit">Save Changes</button>
  </form>
<main>
</body>
</html>



