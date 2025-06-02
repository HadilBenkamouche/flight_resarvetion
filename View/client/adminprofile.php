
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Profile - Nova Travels</title>
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

    main {
      padding: 140px 20px 40px;
      text-align: center;
    }

    h1 {
      color: #333;
      font-size: 36px;
      margin-bottom: 40px;
    }

    .profile-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 30px 20px;
      border-radius: 12px;
      box-shadow: 0px 6px 12px hsla(0, 0%, 0%, 0.1);
    }

    .profile-img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid var(--cherry-red);
    }

    .profile-info {
      width: 100%;
      text-align: left;
      margin-top: 20px;
    }

    .profile-info label {
      font-size: 16px;
      color: #333;
      margin-bottom: 8px;
      display: block;
    }

    .profile-info input {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .footer {
      margin-top: 60px;
      padding: 20px;
      font-size: 12px;
      color: #999999;
      text-align: center;
    }

    .button {
      padding: 10px 20px;
      background-color: var(--cherry-red);
      color: #fff;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #7d010b;
    }

    .cancel-btn {
      background-color: #ccc;
    }

    .cancel-btn:hover {
      background-color: #999;
    }

    .edit-btn {
      background-color: #7d010b;
    }

    .edit-btn:hover {
      background-color: #7d010b;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <div class="navbar">
    <img src="\flight_resarvetion\Logo.png" alt="Logo" class="logo">
    <div class="nav-links">
      <a href="admin-settings.html" class="nav-link">Profile</a>
      <a href="logout.html" class="nav-link">Logout</a>
    </div>
  </div>

  <main>
    <h1>Admin Profile</h1>
    <div class="profile-container">
      <!-- Profile Picture -->
      <img src="\flight_resarvetion\Logo.png" alt="Profile Picture" class="profile-img">

      <div class="profile-info">
        <label for="username">Username</label>
        <input type="text" id="username" value="Team Nova Travls" disabled />

        <label for="email">Email</label>
        <input type="email" id="email" value="admin@novatravels.com" disabled />

        <label for="password">Password</label>
        <input type="password" id="password" value="******" disabled />
      </div>

      <div>
        <button id="editBtn" class="button edit-btn">Edit Profile</button>
        <button id="saveBtn" class="button" style="display: none; margin-left: 10px;">Save Changes</button>
      </div>
    </div>
  </main>

  <div class="footer">
    Nova Travels Admin Panel — Version 1.0
  </div>

  <!-- Interactive Script -->
  <script>
    const editBtn = document.getElementById("editBtn");
    const saveBtn = document.getElementById("saveBtn");
    const inputs = document.querySelectorAll(".profile-info input");

    let hasChanges = false;

    editBtn.addEventListener("click", () => {
      inputs.forEach(input => input.disabled = false);
      editBtn.style.display = "none";
    });

    inputs.forEach(input => {
      input.addEventListener("input", () => {
        if (!hasChanges) {
          saveBtn.style.display = "inline-block";
          hasChanges = true;
        }
      });
    });

    saveBtn.addEventListener("click", () => {
      alert("Changes saved!");

      inputs.forEach(input => input.disabled = true);

      saveBtn.style.display = "none";
      editBtn.style.display = "inline-block";
      hasChanges = false;
    });
  </script>
</body>
</html>