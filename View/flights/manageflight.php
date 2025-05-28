
   <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
    <div class="alert alert-success">تم حذف الرحلة بنجاح.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] == 'delete_failed'): ?>
    <div class="alert alert-danger">فشل في حذف الرحلة.</div>
<?php endif; ?>

   <?php
require_once '../../confi/db.php'; // تأكدي من صحة المسار
require_once '../../Model/flight.php';

$flightModel = new flight($pdo); 
$flights = $flightModel->getAllFlights();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Flights - Admin Dashboard</title>
  <style>
    :root {
      --cherry-red: #b22234;
      --off-white: #ffff;
    }

    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: var(--off-white);
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
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
    }

    .logout-btn {
      background-color: #B22234;
      color: #ffffff;
      border: none;
      border-radius: 25px;
      padding: 10px 20px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #7d010b;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    main {
      padding: 120px 40px 40px;
    }

    h1 {
      text-align: center;
      color: #B22234;
      margin-bottom: 30px;
    }

    .top-actions {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 20px;
    }

    .add-flight-btn {
      background-color: #B22234;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .add-flight-btn:hover {
      background-color: #7d010b;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    th, td {
      padding: 15px 20px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f8f8f8;
      color: #333;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .action-btn {
      padding: 8px 15px;
      margin-right: 5px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .edit-btn {
      background-color: #007bff;
      color: white;
    }

    .edit-btn:hover {
      background-color: #0056b3;
    }

    .delete-btn {
      background-color: #dc3545;
      color: white;
    }

    .delete-btn:hover {
      background-color: #a71d2a;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <img src="your-logo.png" alt="Logo" class="logo" />
    <button class="logout-btn">Logout</button>
  </div>

  <main>
    <h1>Manage Flights</h1>
    <div class="top-actions">
      <a href="../../View/flights/addflight.php" class="add-flight-btn">Add New Flight</a>
    </div>
    <table>
      <thead>
        <tr>
          <th>Flight Number</th>
          <th>Destination</th>
          <th>Departure</th>
          <th>Arrival</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($flights)): ?>
          <?php foreach ($flights as $flight): ?>
            <tr>
              <td><?= htmlspecialchars($flight['flight_number']) ?></td>
              <td><?= htmlspecialchars($flight['destination']) ?></td>
              <td><?= htmlspecialchars($flight['departure_time']) ?></td>
              <td><?= htmlspecialchars($flight['arrival_time']) ?></td>
              <td>
              <a class="action-btn edit-btn" href="editflight.php?flight_number=<?= $flight['flight_number'] ?>">Edit</a>
              <a class="action-btn delete-btn" href="deleteflight.php?flight_number=<?= $flight['flight_number'] ?>" onclick="return confirm('Are you sure you want to delete this flight?')">Delete</a>

              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No flights found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>
</body>
