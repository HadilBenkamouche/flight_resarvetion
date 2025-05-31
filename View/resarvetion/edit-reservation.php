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
  </style>
</head>
<body>

  <h2>Edit Reservation #<?= htmlspecialchars($reservation['reservation_number']) ?></h2>

  <form method="POST" action="\flight_resarvetion\controller\resarvetion.php">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="reservation_number" value="<?= htmlspecialchars($reservation['reservation_number']) ?>">

    <label for="flight_number">Flight Number</label>
    <input type="text" id="flight_number" name="flight_number" value="<?= htmlspecialchars($reservation['flight_number']) ?>" readonly>
    
    <label for="status">Status</label>
    <select name="status" id="status" required>
      <option value="Confirmed" <?= $reservation['STATUS'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
      <option value="Cancelled" <?= $reservation['STATUS'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
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

</body>
</html>



