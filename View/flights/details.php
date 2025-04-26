<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تفاصيل الرحلة</title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background-color: #f0f2f5;
      padding: 30px;
    }
    .flight-details {
      background: white;
      padding: 30px;
      border-radius: 15px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      color: #007BFF;
      text-align: center;
      margin-bottom: 20px;
    }
    p {
      font-size: 16px;
      margin: 10px 0;
    }
    .back {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #007BFF;
      text-decoration: none;
    }
  </style>
</head>
<body>

<div class="flight-details">
  <h2>تفاصيل الرحلة رقم <?= $flightDetails['flight_number'] ?></h2>
  <p><strong>الوجهة:</strong> <?= $flightDetails['destination'] ?></p>
  <p><strong>نوع الرحلة:</strong> <?= $flightDetails['flight_type'] ?></p>
  <p><strong>وقت الإقلاع:</strong> <?= $flightDetails['departure_time'] ?></p>
  <p><strong>وقت الوصول:</strong> <?= $flightDetails['arrival_time'] ?></p>
  <p><strong>شركة الطيران:</strong> <?= $flightDetails['company_code'] ?></p>
  <p><strong>رمز الطائرة:</strong> <?= $flightDetails['aircraft_code'] ?></p>

  <a class="back" href="javascript:history.back()">← العودة إلى النتائج</a>
</div>

</body>
</html>


