
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Flight - Admin Dashboard</title>
  <style>
    :root {
      --cherry-red: #b22234;
      --off-white: #ffffff;
    }

    * {
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: var(--off-white);
      padding-top: 100px;
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
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    main {
      max-width: 500px;
      margin: auto;
      padding: 30px 20px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.08);
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #444;
    }

    input[type="text"],
    input[type="datetime-local"],
    select {
      width: 100%;
      padding: 8px 12px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    .btn-container {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-cancel {
      background-color: #999;
    }

    .btn-cancel:hover {
      background-color: #666;
    }

    .btn-save {
      background-color: var(--cherry-red);
    }

    .btn-save:hover {
      background-color: #7d010b;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <img src="your-logo.png" alt="Logo" class="logo">
    <button class="logout-btn">Logout</button>
  </div>
  <main>
  <h1>Add New Flight</h1>
  <form action="../../controller/flight.php?action=add" method="POST" class="form">
    <label for="flightNumber">Flight Number</label>
    <input type="text" id="flightNumber" name="flightNumber" placeholder="Enter flight number" required>

    <label for="destination">Destination</label>
    <input type="text" id="destination" name="destination" placeholder="Enter destination" required>

    <label for="departure">Departure Time</label>
    <input type="datetime-local" id="departure" name="departure" required>

    <label for="arrival">Arrival Time</label>
    <input type="datetime-local" id="arrival" name="arrival" required>

    <label for="flightType">Flight Type</label>
    <select id="flightType" name="flightType" required>
      <option value="" disabled selected>Select flight type</option>
      <option value="One Way">One Way</option>
      <option value="Round Trip">Round Trip</option>
    </select>

    <div class="btn-container">
      <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
      <button type="submit" class="btn btn-save">Add Flight</button>
    </div>
  </form>
</main>


</body>
</html>