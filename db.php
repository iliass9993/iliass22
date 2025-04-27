<?php
$servername = "localhost";
$username = "root";
$password = "root";
$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);

try {
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<div style='color:white'>Connected successfully</div>";
} catch (PDOException $e) {
    echo "<div style='color:white'>Connection failed: " . $e->getMessage() . "</div>";
}
