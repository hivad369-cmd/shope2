<?php
// تست اتصال MySQLi
$mysqli = new mysqli("localhost", "username", "password", "database");
echo $mysqli ? "MySQLi connected!" : "Error: " . $mysqli->connect_error;

// تست PDO
try {
    $pdo = new PDO("mysql:host=localhost;dbname=database", "username", "password");
    echo "PDO connected!";
} catch (PDOException $e) {
    echo "PDO error: " . $e->getMessage();
}
?>