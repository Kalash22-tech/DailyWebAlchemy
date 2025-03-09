<?php
$host = 'localhost';
$dbname = 'school_noticeboard';
$username = 'root'; // Default MySQL username
$password = '';     // Default MySQL password (empty for XAMPP/WAMP)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>