
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require_once '../../Model/reservtion.php';
   require_once '../../confi/db.php';
    $reservationModel = new Reservation($pdo);       
   $reservations = $reservationModel->getAllReservations();
            
          session_start();

// حفظ الرسالة في متغير ثم حذفها من الجلسة حتى لا تظهر كل مرة
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message'])
       
?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Reservations - Admin Dashboard</title>
  <style>
    :root {
      --cherry-red: #b22234;
      --off-white: #ffffff;
      --light-gray: #f5f5f5;
      --dark-gray: #333;
      --medium-gray: #888;
      --border-radius: 8px;
    }

    * {
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    body {
      margin: 0;
      background-color: var(--off-white);
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 40px;
      background-color: var(--off-white);
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
      color: var(--cherry-red);
      font-weight: bold;
      font-size: 16px;
      transition: color 0.3s ease;
    }

    .nav-link:hover {
      color: #7d010b;
    }

    .profile-btn {
      background-color: #b22234;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: var(--border-radius);
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .profile-btn:hover {
      background-color: #7d010b;
    }

    main {
      padding: 120px 20px;
      color: var(--dark-gray);
    }

    h1 {
      color: var(--dark-gray);
      font-size: 36px;
      text-align: center;
      margin-bottom: 30px;
    }

    .filter-container {
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      max-width: 1000px;
      margin: 0 auto;
    }

    .filter-container select,
    .filter-container input {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: var(--border-radius);
      width: 48%;
      background-color: var(--light-gray);
    }

    .reservations-table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      max-width: 1000px;
      margin: 0 auto;
    }

    .reservations-table th,
    .reservations-table td {
      padding: 12px;
      text-align: left;
      border: 1px solid #ddd;
      background-color: var(--off-white);
      font-size: 16px;
    }

    .reservations-table th {
      background-color: var(--cherry-red);
      color: white;
    }

    .reservations-table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .reservations-table tbody tr:hover {
      background-color: #f1f1f1;
    }

    .action-btns {
      display: flex;
      gap: 10px;
    }

    .btn-edit,
    .btn-cancel {
      padding: 8px 16px;
      border: none;
      border-radius: var(--border-radius);
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      font-size: 14px;
    }

    .btn-edit {
      background-color: #7d010b;
      color: white;
    }

    .btn-edit:hover {
      background-color: #600008;
    }

    .btn-cancel {
      background-color: #f44336;
      color: white;
    }

    .btn-cancel:hover {
      background-color: #d32f2f;
    }

    @media (max-width: 768px) {
      .filter-container {
        flex-direction: column;
        gap: 10px;
      }

      .filter-container select,
      .filter-container input {
        width: 100%;
      }

      .reservations-table th,
      .reservations-table td {
        font-size: 14px;
      }

      .action-btns {
        flex-direction: column;
        gap: 5px;
      }

      .btn-edit,
      .btn-cancel {
        width: 100%;
        padding: 10px;
      }
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
  
  <?php if (!empty($message)): ?>
  <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
    <?= htmlspecialchars($message) ?>
  </div>
<?php endif; ?>
  
  
  <h1>Manage Reservations</h1>

    <div class="filter-container">
      <select>
        <option value="upcoming">Upcoming Reservations</option>
        <option value="past">Past Reservations</option>
      </select>
      <input type="text" placeholder="Search by Reservation ID or Customer Name">
    </div>

    <table class="reservations-table">
      <thead>
        <tr>
          <th>Reservation ID</th>
          <th>Customer Name</th>
          <th>Flight Number</th>
          <th>Reservation Date</th>
          <th>Departure Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
  <?php if (!empty($reservations)): ?>
    <?php foreach ($reservations as $res): ?>
      <tr>
        <td><?= htmlspecialchars($res['reservation_number']) ?></td>
        <td><?= htmlspecialchars($res['customer_name']) ?></td>
        <td><?= htmlspecialchars($res['flight_number']) ?></td>
        <td><?= htmlspecialchars($res['reservation_date']) ?></td>
        <td><?= htmlspecialchars($res['departure_time']) ?></td>
        <td><?= htmlspecialchars($res['status']) ?></td>
        <td class="action-btns">
          <button class="btn-edit" onclick="editReservation('<?= htmlspecialchars($res['reservation_number']) ?>')">Edit</button>
            
          <form method="POST" action="delete-reservation.php" style="display:inline;">
  <input type="hidden" name="reservation_number" value="<?= htmlspecialchars($res['reservation_number']) ?>">
  <button type="submit" class="btn-cancel" onclick="return confirm('Are you sure you want to delete this reservation? ');">Delete</button>
</form>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="7" style="text-align:center;">لا توجد حجوزات حالياً</td></tr>
  <?php endif; ?>
</tbody>
 </table>
  </main>

  <script>
    function editReservation(reservationId) {
      window.location.href = `edit-reservation.php?action=edit&reservation_number=${reservationId}`;

    }
  </script>
</body>
</html>