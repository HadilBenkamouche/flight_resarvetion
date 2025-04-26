
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Sign Up Page</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #ffffff, #fefeffc4);
      font-family: Arial, sans-serif;
    }

    .container {
      width: 449px;
      background-color: rgb(255, 255, 255);
      border-radius: 30px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
      margin: 2px auto;
      padding: 30px 20px 20px 20px;
      text-align: center;
      position: relative;
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 538px;
      overflow: hidden;
      border: 5px solid #ffffff;
    }

    .logo {
      width: 300px;
      height: auto;
      margin-top: -40px;
      margin-bottom: -70px;
    }

    .form {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 10px;
      z-index: 2;
    }

    .input-container {
      position: relative;
      width: 80%;
      margin: 6px 0;
    }

    .input-container input {
      width: 100%;
      padding: 12px;
      padding-top: 18px;
      font-size: 16px;
      border: 2px solid #b22234;
      border-radius: 10px;
      outline: none;
      color: #b22234;
      background: transparent;
    }

    .input-container label {
      position: absolute;
      top: 12px;
      left: 15px;
      color: #b22234;
      pointer-events: none;
      transition: 0.3s ease all;
      background: white;
      padding: 0 5px;
    }

    .input-container input:focus + label,
    .input-container input:valid + label {
      top: -8px;
      left: 10px;
      font-size: 12px;
      color: #7d010b;
    }

    .input-container input:focus {
      box-shadow: 0 0 10px rgba(178, 34, 52, 0.5);
      transition: box-shadow 0.3s ease;
    }

    .signup-btn {
      background-color: #b22234;
      color: white;
      font-weight: bold;
      padding: 12px 25px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .signup-btn:hover {
      background-color: #7d010b;
      transform: scale(1.05);
    }

    .login {
      margin-top: 10px;
      font-size: 14px;
      color: #b22234;
    }

    .login-link {
      color: #b22234;
      text-decoration: none;
      font-weight: bold;
      margin-left: 5px;
      transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .login-link:hover {
      color: #7d010b;
      text-decoration: underline;
    }

    .bottom-left-img {
      position: absolute;
      bottom: -40px;
      left: 0;
      width: 100%;
      height: auto;
      z-index: 1;
    }
  </style>
</head>
<body>

<div class="container">
  <img src="Logo.png" alt="Logo" class="logo">

  <form action="../../controller/client.php" method="POST" class="form">
    <div class="input-container">
      <input type="text" name="username" required />
      <label>Username</label>
    </div>

    <div class="input-container">
      <input type="email" name="email" required />
      <label>Email</label>
    </div>

    <div class="input-container">
      <input type="password" name="password" required />
      <label>Password</label>
    </div>

    <button type="submit" class="signup-btn">Sign Up</button>

    <div class="login">
      Already have an account? <a href="login.php" class="login-link">LOGIN</a>
    </div>
    </form>
</div>


    <img src="loginpage.png" alt="Bottom Image" class="bottom-left-img">
  </div>
  
</body>
</html>