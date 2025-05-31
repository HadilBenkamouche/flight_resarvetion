<?php
require_once '../../controller/ClientAdminController.php';
require_once '../../confi/db.php';

$controller = new ClientAdminController($pdo);

// 1. جلب id المستخدم من الرابط
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // إذا لم يُمرر id، نعيد التوجيه إلى الصفحة الرئيسية
    header('Location: manage-users.php');
    exit;
}

$clientId = $_GET['id'];

// 2. جلب بيانات المستخدم بواسطة id
$client = $controller->getClientById($clientId);
if (!$client) {
    // إذا لم يوجد مستخدم بالمعرف هذا، نعيد التوجيه
    header('Location: manage-users.php');
    exit;
}

// 3. إذا تم إرسال النموذج (POST)، نقوم بمعالجة التحديث
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استقبال البيانات من الفورم
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    // تحقق بسيط من صحة البيانات
    if (empty($firstName)) {
        $errors[] = 'First name is required.';
    }
    if (empty($lastName)) {
        $errors[] = 'Last name is required.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }

    // تحقق هل البريد مستخدم من قبل مستخدم آخر
    if ($email !== $client['email'] && $controller->emailExists($email)) {
        $errors[] = 'This email is already taken by another user.';
    }

    // لو ما في أخطاء نحدث بيانات المستخدم
    if (empty($errors)) {
        $updated = $controller->updateClient($clientId, $firstName, $lastName, $email, $phone);
        if ($updated) {
            $success = true;
            // جلب البيانات المحدثة للعرض في الفورم بعد التحديث
            $client = $controller->getClientById($clientId);
        } else {
            $errors[] = 'Failed to update the user. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit User - Nova Travels</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    /* نفس تصميم manage-users.php لتناسق */
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
      max-width: 600px;
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

    form {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    label {
      font-weight: 600;
      color: #555;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"] {
      padding: 10px 12px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
      width: 100%;
    }

    button {
      background-color: var(--cherry-red);
      border: none;
      color: white;
      padding: 12px 20px;
      font-size: 18px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 10px;
    }

    button:hover {
      background-color: #7d010b;
    }

    .message {
      text-align: center;
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 6px;
      font-weight: bold;
    }

    .error {
      background-color: #f8d7da;
      color: #842029;
      border: 1px solid #f5c2c7;
    }

    .success {
      background-color: #d1e7dd;
      color: #0f5132;
      border: 1px solid #badbcc;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <div class="navbar">
    <img src="your-logo.png" alt="Logo" class="logo" />
    <div class="nav-links">
      <a href="admin-profile.html" class="nav-link">Profile</a>
      <a href="logout.php" class="nav-link">Logout</a>
    </div>
  </div>

  <!-- Main container -->
  <div class="container">
    <h2>Edit User</h2>

    <?php if (!empty($errors)): ?>
      <div class="message error">
        <?php foreach ($errors as $error) {
          echo htmlspecialchars($error) . '<br>';
        } ?>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="message success">
        ✅ User updated successfully!
      </div>
    <?php endif; ?>

    <form method="post" action="">
      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($client['first_name']) ?>" required />

      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($client['last_name']) ?>" required />

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required />

      <label for="phone">Phone</label>
      <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($client['phone'] ?? '') ?>" />

      <button type="submit">Save Changes</button>
    </form>

    <p style="margin-top: 15px; text-align: center;">
      <a href="manage-users.php" style="color: var(--cherry-red); text-decoration: none;">← Back to Manage Users</a>
    </p>
  </div>
</body>

</html>