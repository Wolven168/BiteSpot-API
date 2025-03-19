<?php
// config/db.php

$host = 'localhost'; // or your database host
$dbname = 'bitespot_db';
$username = 'root';  // change this if you use a different MySQL username
$password = '';  // change this if you use a password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
