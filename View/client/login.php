
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login Page</title>
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
      z-index: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 538px;
      overflow: visible;
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
      margin-bottom: 15px;
      z-index: 2;
    }

    .input-container {
      position: relative;
      width: 80%;
      margin: 10px 0;
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

    .forgot {
      color: #b22234;
      font-size: 14px;
      text-decoration: none;
      margin-top: 8px;
      margin-bottom: 10px;
      position: relative;
      transition: all 0.3s ease;
    }

    .forgot::after {
      content: "";
      position: absolute;
      width: 0;
      height: 2px;
      left: 0;
      bottom: -2px;
      background-color: #b22234;
      transition: width 0.3s ease;
    }

    .forgot:hover::after {
      width: 100%;
    }

    .login-btn {
      background-color: #b22234;
      color: white;
      font-weight: bold;
      padding: 12px 25px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .login-btn:hover {
      background-color: #7d010b;
      transform: scale(1.05);
    }

    .signup {
      margin-top: 15px;
      font-size: 14px;
      color: #b22234;
    }

    .signup-link {
      color: #b22234;
      text-decoration: none;
      font-weight: bold;
      margin-left: 5px;
      transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .signup-link:hover {
      color: #7d010b;
      text-decoration: underline;
    }

    .bottom-left-img {
  position: absolute;
  bottom: 20px;
  left: 5px;
  width: 500px;
  height: auto;
  z-index: 0;
  pointer-events: none;
}


  </style>
</head>
<body>

  <div class="container">
    <img src="Logo.png" alt="Logo" class="logo">
    <form action="../../controller/client.php" method="POST" class="form">
  <input type="hidden" name="action" value="login">

  <div class="input-container">
    <input type="text" name="email" required />
    <label>Email</label>
  </div>

  <div class="input-container">
    <input type="password" name="password" required />
    <label>Password</label>
  </div>

  <a href="#" class="forgot">Forget password?</a>
  <button type="submit" class="login-btn">Login</button>

  <div class="signup">
    Need an account? <a href="signup.php" class="signup-link">SIGN UP</a>
  </div>
</form>
<img src="loginpage.png" alt="Bottom Image" class="bottom-left-img">
      
    </div>
    
    
    
  </div>
  
</body>
</html>