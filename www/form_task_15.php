<?php
require_once 'database.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->execute([':email' => $email]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($result) OR !password_verify($password, $result['password']))
{
    $_SESSION['danger'] = 'Неверный логин или пароль';
    header('Location: task_15.php');
    exit();
}

$_SESSION['user'] = ['email' => $result['email']];
header('Location: task_16.php');
