<?php if (isset($_GET['deleted'])): ?>
    <div class="message <?= $_GET['deleted'] ? 'success' : 'error' ?>">
        <?= $_GET['deleted'] ? 'User deleted successfully.' : 'Failed to delete user.' ?>
    </div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Users - Nova Travels</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    :root {
      --cherry-red: #b22234;
      --off-white: #ffffff;
    }

    * {
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    body {
      margin: 0;
      background-color: #f4f6f9;
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
      margin-bottom: 1mm;
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
      background-color: var(--cherry-red);
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .nav-link:hover {
      color: #7d010b;
    }

    .container {
      max-width: 1000px;
      margin: 130px auto 50px;
      background-color: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
      font-size: 28px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 14px 16px;
      text-align: left;
    }

    th {
      background-color: var(--cherry-red);
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .action-buttons button {
      background-color: var(--cherry-red);
      border: none;
      color: white;
      padding: 6px 12px;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 6px;
      transition: background-color 0.3s ease;
    }

    .action-buttons button:hover {
      background-color: #7d010b;
    }

    .action-buttons button.delete {
      background-color: #c73748;
    }

    .action-buttons button.delete:hover {
      background-color: #B22234;
    }
  </style>
</head>

<body>
  <?php
   require_once '../../controller/ClientAdminController.php';
   require_once '../../confi/db.php';

   
   $controller = new ClientAdminController($pdo);
   $clients = $controller->getAllClients();
   
  ?>
<?php if (isset($_GET['deleted'])): ?>
    <div style="margin: 80px auto 20px; max-width: 800px; padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; text-align: center;">
    ✅ User has been successfully deleted.
  </div>
<?php endif; ?>

  <!-- Navbar -->
  <div class="navbar">
    <img src="\flight_resarvetion\Logo.png" alt="Logo" class="logo">
    <div class="nav-links">
      <a href="\flight_resarvetion\View\client\adminprofile.php" class="nav-link">Profile</a>
      <a href="\flight_resarvetion\controller\lougoutController.php" class="nav-link">Logout</a>
    </div>
  </div>

  <!-- Main content -->
  <div class="container">
    <h2>Manage Users</h2>
    <table>
      <thead>
        <tr>
          <th>User ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<?php 
if (empty($clients)) {
    echo '<tr><td colspan="5" style="text-align:center;">No clients found.</td></tr>';
} else {
    foreach ($clients as $client): ?>
      <tr>
        <td><?= htmlspecialchars($client['client_id']) ?></td>
        <td><?= htmlspecialchars($client['first_name'] . ' ' . $client['last_name']) ?></td>
        <td><?= htmlspecialchars($client['email']) ?></td>
        <td><?= htmlspecialchars($client['phone'] ?? 'N/A') ?></td>
        <td class="action-buttons">
          <button onclick="location.href='edit-user.php?id=<?= urlencode($client['client_id']) ?>'">Edit</button>
          <button class="delete" onclick="if(confirm('Are you sure?')) location.href='delet-user.php?id=<?= urlencode($client['client_id']) ?>'">Delete</button>
        </td>
      </tr>
<?php 
    endforeach;
} 
    ?>
</tbody>

    </table>
  </div>
</body>

</html>