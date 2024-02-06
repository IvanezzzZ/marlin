<?php
session_start();
require_once 'database.php';

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "SELECT email FROM users WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->execute([':email' => $email]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($result))
{
    $_SESSION['danger'] = 'Пользователь с такой почтой уже существует';
    header('Location: task_12.php');
    exit();
}

$query = "INSERT INTO users (email, password) VALUES (:email, :password)";
$stmt = $pdo->prepare($query);
$stmt->execute([':email' => $email, ':password' => $password]);

$_SESSION['success'] = 'Вы успешно зарегестрированы';
header('Location: task_12.php');