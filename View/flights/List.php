<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>قائمة الرحلات</title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 20px;
    }
    h2 {
      color: #007BFF;
      text-align: center;
    }
    .flight-card {
      background-color: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .flight-card p {
      margin: 8px 0;
    }
    .btn {
      display: inline-block;
      padding: 10px 15px;
      background-color: #28a745;
      color: white;
      text-decoration: none;
      border-radius: 8px;
    }
    .btn:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>

<h2>الرحلات المتاحة</h2>

<?php if (count($flights) > 0): ?>
  <?php foreach ($flights as $flight): ?>
    <div class="flight-card">
      <p><strong>رقم الرحلة:</strong> <?= $flight['flight_number'] ?></p>
      <p><strong>شركة الطيران:</strong> <?= $flight['company_code'] ?></p>
      <p><strong>الإقلاع:</strong> <?= $flight['departure_time'] ?></p>
      <p><strong>الوصول:</strong> <?= $flight['arrival_time'] ?></p>
      <a class="btn" href="../../controllers/flight.php?action=details&flight_number=<?= $flight['flight_number'] ?>">عرض التفاصيل</a>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p style="text-align:center; color: red;">لا توجد رحلات حالياً.</p>
<?php endif; ?>

</body>
</html>





