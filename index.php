<?php


require_once __DIR__ . '/confi/db.php';
require_once __DIR__ . '/Model/airport.php';

$airportModel = new Airport($pdo);
$departureAirports = $airportModel->getDepartureAirports();
$arrivalAirports = $airportModel->getArrivalAirports();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nova Travel</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@900&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }
    body {
      margin: 0;
      background-color: #ffffff;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: flex-start;
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
      width: 170px; /* العرض */
      height: auto; /* يجعل الارتفاع يتناسب تلقائياً */
      margin-right: 140px;  
    margin-bottom: 1mm; /* إضافة المسافة بين الشعار و شريط البحث */
}
    

    .search-bar input {
      margin-left: 1px;
      padding: 10px 20px;
      border-radius: 25px;
      border: 1.4px solid #B22234;
      width: 300px;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .search-bar input:focus {
      outline: none;
      border-color: #B22234;
      box-shadow: 0 0 5px #7d010b;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 30px;
      margin-left: 40px;
    }

    .nav-link {
      text-decoration: none;
      color: #B22234;
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
      background-color: #B22234;
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .nav-link:hover {
      color: #7d010b;
    }

    .auth-buttons {
      display: flex;
      gap: 15px;
      margin-left: auto;
      padding-right: 20px;
    }

    .login-btn,
    .signup-btn {
      background-color: #B22234;
      color: #ffffff;
      border: none;
      border-radius: 25px;
      padding: 10px 20px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-btn:hover,
    .signup-btn:hover {
      background-color: #7d010b;
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .hero-image {
      margin-top: 60px;
      background-image: url('homebcg.jpg');
      background-size: cover;
      background-position: center;
      height: 533px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      text-align: left;
      color: #ffffff;
      position: relative;
    }

    .gallery-wrapper {
      position: absolute;
      top: 0;
      right: 0;
      width: 35vw;
      height: 100%;
      display: flex;
      gap: 1mm;
      background: rgba(255, 255, 255, 0);
      z-index: 1;
    }

    .column {
      width: 50%;
      height: 100%;
      overflow: hidden;
      position: relative;
    }

    .scroll-images {
      position: absolute;
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .scroll-images img {
      width: 100%;
      height: 300px;
      border-radius: 15px;
      object-fit: cover;
    }

    .scroll-down {
      animation: scrollDown 39s linear infinite;
    }

    .scroll-up {
      animation: scrollUp 39s linear infinite;
    }
 
    @keyframes scrollDown {
  0% { transform: translateY(0); }
  100% { transform: translateY(-50%); }
}
    

@keyframes scrollUp {
  0% { transform: translateY(-50%); }
  100% { transform: translateY(0); }
}
    .hero-text {
      padding-left: 25px;
      margin-top: -160px;
      position: relative;
      z-index: 2;
    }

    .hero-text p {
      font-family: 'League Spartan', sans-serif;
      font-size: 50px;
      font-weight: 900;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
      margin: 0;
      line-height: 1.2;
      color: #ffffff;
    }

    .container {
      background: #ffffff;
  padding: 40px;
  margin: 60px auto;
  border-radius: 25px;
  box-shadow: 0 4px 35px rgba(0, 0, 0, 0.1);
  width: 90%;
  max-width: 1000px;
  animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #B22234;
    }

    .form-group {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-control {
       flex: 1;
      display: flex;
      flex-direction: column;
      gap: 4px; /* المسافة بين label و input/select */
      transition: transform 0.2s ease;
    }

    .form-control:hover {
      transform: translateY(-2px);
    }

    .form-control label {
      font-weight: bold;
      margin-bottom: 8px;
      color: #7d010b;
    }

    .form-control input,
    .form-control select {
      height: 48px;
  padding: 10px;
  border: 2px solid #B22234;
  border-radius: 8px;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  box-sizing: border-box;
  font-size: 16px;
    }

    .form-control input:focus,
    .form-control select:focus {
      border-color: #7d010b;
      outline: none;
      box-shadow: 0 0 5px #7d010b66;
    }
    .passenger-inputs {
  display: flex;
  gap: 15px;
  flex-direction: row;
}

.passenger-inputs div {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 5px;
}

.passenger-inputs input {
  width: 2cm;
  height: 1cm;
  padding: 2px;
  font-size: 12px;
  text-align: center;
  border: 2px solid #B22234;
  border-radius: 6px;
  box-sizing: border-box;
}
    
    .search-button {
      display: block;
      width: 100%;
      padding: 15px;
      background-color: #B22234;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .search-button:hover {
      background-color: #7d010b;
      transform: scale(1.02);
    }
    /* Responsive Design (اختياري للهاتف) */
@media (max-width: 768px) {
  .form-group.row {
    flex-direction: column;
  }

  .form-control {
    width: 100%;
  }

  .passenger-inputs {
    flex-direction: column;
  }
}

    .floating-button {
      margin-top: 100px; /* قلل القيمة أو حتى حط 0 */
      position: fixed;
      bottom: 110px;
      left: 20px;
      width: 85px;
      height: 85px;
      z-index: 999;
      border-radius: 50%;
      overflow: hidden;
      background-color: #B22234;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .floating-button img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .floating-button:hover {
      transform: scale(1.1);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
    .offers-section {
  padding: 50px 20px;
  background-color: #ffffff;
}
.offer-label {
  position: absolute;
  top: 15px;
  left: 15px;
  color: white;
  font-size: 22px;
  font-weight: bold;
  z-index: 2;
  text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5); /* باش يبان على الصورة */
  background: none; /* نحي الخلفية البيضاء */
  padding: 0; /* نحي الحواف */
  margin: 0;
  transition: opacity 0.3s ease;
}

.offer-card:hover .offer-label {
  opacity: 0;
}


.offer-card:hover .offer-label {
  opacity: 0;
}

.offers-section h1 {
  text-align: center;
  margin-bottom: 40px;
  font-size: 36px;
  font-weight: bold;
  color: #B22234;
}

/* Pinterest-style gallery */
.offers-gallery {
  column-count: 3;
  column-gap: 20px;
}

.offer-card {
  position: relative;
  break-inside: avoid;
  margin-bottom: 20px;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
  background-color: #fff;
}

.offer-card:hover {
  transform: translateY(-5px);
}

.offer-card img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
}

/* Offer overlay (shows on hover) */
.offer-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(178, 34, 52, 0.95); /* semi-transparent red */
  color: #ffffff;
  padding: 20px;
  opacity: 0;
  transition: opacity 0.3s ease;
  font-family: Arial, sans-serif;
  font-size: 14px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.offer-card:hover .offer-overlay {
  opacity: 1;
}

.offer-overlay h2 {
  font-size: 18px;
  margin-bottom: 10px;
}

.offer-overlay p {
  margin-bottom: 10px;
  font-size: 15px;
}

.offer-overlay ul {
  margin: 0;
  padding-left: 20px;
  list-style: disc;
}

.offer-overlay .note {
  margin-top: 10px;
  font-style: italic;
}

/* Optional title below image (not needed with overlay, but you can keep it) */
.offer-card span.offer-label {
  position: absolute;
  top: 15px;
  left: 15px;
  color: #ffffff;
  font-size: 30px;
  font-weight: bold;
  z-index: 2;
  text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
  background: none;
  padding: 0;
  margin: 0;
  transition: opacity 0.3s ease;
  text-align: left;
}

.offer-card:hover .offer-label {
  opacity: 0;
}

/* Responsive tweaks */
@media (max-width: 1024px) {
  .offers-gallery {
    column-count: 2;
  }
}

@media (max-width: 600px) {
  .offers-gallery {
    column-count: 1;
  }

  .offer-overlay {
    font-size: 13px;
    padding: 15px;
  }

  .offer-overlay h2 {
    font-size: 16px;
  }
}
.payments-section {
  text-align: center;
  padding: 40px 20px;
  background-color: #ffffff;
  margin-top: 80px; 
}

.payments-section h2 {
  font-size: 23px;
  margin-bottom: 20px;
  font-weight: bold;
  color: #B22234;
}

.payment-icons {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
  flex-wrap: wrap;
  margin-top: 20px;
}

.payment-icons img {
  width: 50px;
  height: auto;
  transition: transform 0.3s ease;
}

.payment-icons img:hover {
  transform: scale(1.1);
}

  </style>
</head>
<body>

  <div class="navbar">
    
    <img src="Logo.png" alt="Logo" class="logo">
    <div class="search-bar">
      <input type="text" placeholder="Search...">
    </div>
    <div class="nav-links">
      <a href="#" class="nav-link">Home</a>
     <a href="controller/flight.php?action=List" class="nav-link">Flights</a>
      <a href="#" class="nav-link">Contact Us</a>
    </div>
    <div class="auth-buttons">
    <a href="View/client/login.php" class="login-btn">Login</a>
    <a href="View/client/signup.php" class="signup-btn">Sign Up</a>
    </div>
  </div>

  <div class="hero-image">
    <div class="hero-text">
      <p>Explore new places<br>create unforgettable<br> memories</p>
    </div>
    <div class="gallery-wrapper">
      <div class="column">
        <div class="scroll-images scroll-down">
          <img src="rome.jfif">
          <img src="paris.jpg">
          <img src="Dubai-1.jpg">
          <img src="arabie saoudite.webp">
          <img src="chinese.jpg">
          <img src="rome.jfif">
          <img src="paris.jpg">
          <img src="Dubai-1.jpg">
          <img src="arabie saoudite.webp">
          <img src="chinese.jpg">
        </div>
     </div>
      <div class="column">
        <div class="scroll-images scroll-up">
          <img src="new-york-vogue-city-guide.webp">
          <img src="London.jpg">
          <img src="japan.webp">
          <img src="cairo-egypt.webp">
          <img src="alg.jpg">
          <img src="new-york-vogue-city-guide.webp">
          <img src="London.jpg">
          <img src="japan.webp">
          <img src="cairo-egypt.webp">
          <img src="alg.jpg">
        </div>
      </div>
    </div>
  </div>

  
  <div class="container" id="flightForm">
    <h1>Book Your Flight</h1>
    <form action="controller/flight.php" method="GET"> 
    <input type="hidden" name="action" value="search">

    <div class="form-group">
        <div class="form-control">
            <label>Type of Flight</label>
            <select name="trip_type" id="trip_type" required onchange="toggleReturnDate()">
              <option value="">Select</option>
                <option value="oneway">One Way</option>
                <option value="roundtrip">Round Trip</option>
            </select>
        </div>

         <!-- مطارات الانطلاق -->
<div class="form-control">
    <label>From</label>
    <select name="from" required>
        <option value="">Select Airport</option>
        <?php foreach ($departureAirports as $airport): ?>
            <option value="<?= htmlspecialchars($airport['iata_code']) ?>">
                <?= htmlspecialchars($airport['city_name'] . " - " . $airport['airport_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<!-- مطارات الوصول -->
<div class="form-control">
    <label>To</label>
    <select name="to" required>
        <option value="">Select Airport</option>
        <?php foreach ($arrivalAirports as $airport): ?>
            <option value="<?= htmlspecialchars($airport['iata_code']) ?>">
                <?= htmlspecialchars($airport['city_name'] . " - " . $airport['airport_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
</div>

       <div class="form-group row">
      <div class="form-control">
        <label>Departure Date</label>
        <input type="date"name="departure_date" required>
      </div>

      <div class="form-control">
        <label>Return Date</label>
        <input type="date"name="return_date"id="return_date" >
      </div>

      <div class="form-control">
        <label>Passengers</label>
        <div class="passenger-inputs">
          <div>
            <label>Adults</label>
            <input type="number" min="1" max="10" value="1">
          </div>
          <div>
            <label>Children</label>
            <input type="number" min="0" max="10" value="0">
          </div>
          <div>
            <label>Infants</label>
            <input type="number" min="0" max="10" value="0">
          </div>
        </div>
      </div>
    </div>

    <button type="submit" class="search-button">Search Flights</button>
  </form>
</div>

<script>
function toggleReturnDate() {
  const tripType = document.getElementById("trip_type").value;
  const returnInput = document.getElementById("return_date");
  const returnContainer = document.getElementById("return_date_container");

  if (tripType === "roundtrip") {
    returnContainer.style.display = "block";
    returnInput.required = true;
  } else {
    returnContainer.style.display = "none";
    returnInput.required = false;
    returnInput.value = "";
  }
}

// تشغيل عند تحميل الصفحة للتأكد من الحالة الحالية
document.addEventListener("DOMContentLoaded", function () {
  toggleReturnDate();
});
</script>

  <!-- OFFERS SECTION -->
<div class="offers-section">
    <h1>Offers and Promotions</h1>
    <div class="offers-gallery">
  
      <!-- Milan -->
      <div class="offer-card">
          <span class="offer-label">Milan</span>
          <img src="milan.webp" alt="Algiers - Milan">
          <div class="offer-overlay">
            <h2>Algiers – Milan</h2>
            <p><strong>Starting from:</strong> 23,300.00 DZD incl. taxes</p>
            <ul>
              <li>Economy</li>
              <li>Round Trip</li>
              <li>Purchase dates: April 7, 2025 to April 30, 2025</li>
              <li>Travel dates: April 7, 2025 to October 25, 2025</li>
              <li>Refundable: No</li>
              <li>Changeable: Yes (with fees)</li>
            </ul>
            <p class="note">Subject to restrictions</p>
          </div>
        </div>
  
      <!-- Marseille -->
      <div class="offer-card">
          <span class="offer-label">Marseille</span>
          <img src="marseille.jpeg" alt="Oran - Marseille">
          <div class="offer-overlay">
            <h2>Oran – Marseille</h2>
            <p><strong>Starting from:</strong> 15,000.00 DZD incl. taxes</p>
            <ul>
              <li>Economy</li>
              <li>Round Trip</li>
              <li>Purchase dates: April 7, 2025 to April 30, 2025</li>
              <li>Travel dates: April 7, 2025 to October 25, 2025</li>
              <li>Refundable: No</li>
              <li>Changeable: Yes (with fees)</li>
            </ul>
            <p class="note">Subject to restrictions</p>
          </div>
        </div>
  
      <!-- Istanbul -->
      <div class="offer-card">
          <span class="offer-label">Istanbul</span>
          <img src="istanbul.jpg" alt="Annaba - Istanbul" />
          <div class="offer-overlay">
            <h2>Annaba – Istanbul</h2>
            <p><strong>Starting from:</strong> 35,940.00 DZD incl. taxes</p>
            <ul>
              <li>Economy</li>
              <li>Round Trip</li>
              <li>Purchase dates: April 9, 2025 to April 23, 2025</li>
              <li>Travel dates: April 9, 2025 to June 14, 2025</li>
              <li>Refundable: No</li>
              <li>Changeable: Yes (with fees)</li>
            </ul>
            <p class="note">Subject to restrictions</p>
          </div>
      </div>
  
      <!-- Geneva -->
      <div class="offer-card">
          <span class="offer-label">Geneva</span>
          <img src="Genève.webp" alt="Algiers - Geneva" />
          <div class="offer-overlay">
            <h2>Algiers – Geneva</h2>
            <p><strong>Starting from:</strong> 22,200.00 DZD incl. taxes</p>
            <ul>
              <li>Economy</li>
              <li>Round Trip</li>
              <li>Purchase dates: April 7, 2025 to April 30, 2025</li>
              <li>Travel dates: April 7, 2025 to October 25, 2025</li>
              <li>Refundable: No</li>
              <li>Changeable: Yes (with fees)</li>
            </ul>
            <p class="note">Subject to restrictions</p>
          </div>
      </div>
  
      <!-- Frankfurt -->
      <div class="offer-card">
          <span class="offer-label">Frankfurt</span>
          <img src="francfort.jpg" alt="Algiers - Frankfurt" />
          <div class="offer-overlay">
            <h2>Algiers – Frankfurt</h2>
            <p><strong>Starting from:</strong> 21,900.00 DZD incl. taxes</p>
            <ul>
              <li>Economy</li>
              <li>Round Trip</li>
              <li>Purchase dates: April 7, 2025 to April 30, 2025</li>
              <li>Travel dates: April 7, 2025 to October 25, 2025</li>
              <li>Refundable: No</li>
              <li>Changeable: Yes (with fees)</li>
            </ul>
            <p class="note">Subject to restrictions</p>
          </div>
      </div>
  
      <!-- Montreal -->
      <div class="offer-card">
          <span class="offer-label">Montreal</span>
          <img src="montreal.jpg" alt="Algiers - Montreal" />
          <div class="offer-overlay">
            <h2>Algiers – Montreal</h2>
            <p><strong>Starting from:</strong> 82,960.00 DZD incl. taxes</p>
            <ul>
              <li>Economy</li>
              <li>Round Trip</li>
              <li>Purchase dates: April 9, 2025 to April 23, 2025</li>
              <li>Travel dates: April 9, 2025 to June 14, 2025</li>
              <li>Refundable: No</li>
              <li>Changeable: Yes (with fees)</li>
            </ul>
            <p class="note">Subject to restrictions</p>
          </div>
      </div>
  
    </div>
  </div>
  
  <a href="#flightForm" class="floating-button">
    <img src="button.png" alt="Réserver">
  </a>
<!-- Payments Accepted Section -->
<section class="payments-section">
    <h2>Payments Accepted</h2>
    <div class="payment-icons">
      <img src="1.png" alt="Payment 1">
      <img src="2.png" alt="Payment 2">
      <img src="3.png" alt="Payment 3">
      <img src="4.png" alt="Payment 4">
      <img src="5.png" alt="Payment 5">
      <img src="6.png" alt="Payment 6">
    </div>
  </section>
</body>
</html>