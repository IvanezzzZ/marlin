<?php
$host = 'mysql7';
$dbname = 'marlin';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $exception) {
    echo $exception->getMessage();
}
