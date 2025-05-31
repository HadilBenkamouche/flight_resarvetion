<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Settings</title>
  <style>
    :root {
      --cherry-red: #b22234;
      --off-white: #ffffff;
      --gray: #ccc;
      --dark-gray: #666;
    }
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      background-color: var(--off-white);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      background-color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 40px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      z-index: 1000;
    }
    .logo {
      width: 150px;
    }
    .logout-btn {
      background-color: var(--cherry-red);
      color: white;
      border: none;
      border-radius: 20px;
      padding: 8px 18px;
      font-weight: bold;
      cursor: pointer;
      text-decoration: none;
    }
    main {
      width: 800px;
      background-color: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      margin-top: 100px;
    }
    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    .setting {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 25px;
      padding-bottom: 12px;
      border-bottom: 1px solid #eee;
    }
    .setting label {
      flex: 1;
      font-weight: bold;
      color: #444;
    }
    .setting input {
      flex: 2;
      padding: 6px 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      width: 100%;
    }
    .button-group {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 30px;
    }
    .save-btn {
      background-color: var(--cherry-red);
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }
    .cancel-btn {
      background-color: var(--gray);
      color: var(--dark-gray);
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="navbar">
  <img src="your-logo.png" alt="Logo" class="logo">
  <a href="logout.php" class="logout-btn">Logout</a>
</div>

<main>
  <h1>User Settings</h1>

  <?php if (isset($_GET['success'])): ?>
    <p style="color: green; text-align:center; font-weight:bold;">✔ تم حفظ التغييرات بنجاح</p>
  <?php endif; ?>

  <form method="POST" action="../controller/setting.php">
    <div class="setting">
     <label for="first_name">First Name</label>
      <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required />
    </div>

    <div class="setting">
      <label for="last_name">Last Name</label>
      <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required />
    </div>
    <div class="setting">
      <label for="email">Email</label>
      <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />
    </div>

    <div class="setting">
      <label for="password">New Password</label>
      <input type="password" name="password" placeholder="أدخل كلمة مرور جديدة (اختياري)" />
    </div>

    <div class="button-group">
      <button type="reset" class="cancel-btn">Cancel</button>
      <button type="submit" class="save-btn">Save Changes</button>
    </div>
  </form>
</main>

</body>
</html>