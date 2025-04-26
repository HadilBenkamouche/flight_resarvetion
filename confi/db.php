<?php
$host = "127.0.0.1:3308"; // Port changed to 3308
$user = "root";
$pass = "";
$dbname = "flight-reservation";

try {
    $dsn = "mysql:host=127.0.0.1;port=3308;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Connected to MySQL with PDO!";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
?>
