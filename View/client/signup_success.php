
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Signup Confirmation</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #f8f8f8;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .notification-box {
      position: relative;
      background-color: #fff;
      border: 2px solid#0f9653;
      color: #0e6f3e;
      padding: 30px 40px;
      border-radius: 15px;
      font-size: 18px;
      font-weight: bold;
      width: 320px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      text-align: center;
      animation: slideDown 0.4s ease-out;
    }

    .notification-box .close-btn {
      position: absolute;
      top: 8px;
      right: 12px;
      background: none;
      border: none;
      color: #0f9653;
      font-size: 22px;
      cursor: pointer;
      font-weight: bold;
    }

    @keyframes slideDown {
      from { transform: translateY(-20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .line {
      display: block;
      margin-bottom: 8px;
    }
  </style>
</head>
<body>

<div class="notification-box" id="successBox">
  <span class="line">You have successfully</span>
  <span class="line">signed up!</span>
<button class="close-btn" onclick="window.location.href='../client/signup.php';">×</button>


</div>

</body>
</html>