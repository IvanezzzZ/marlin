<?php

session_start();
require_once 'database.php';

$text = $_POST['text'];

$query = "SELECT text FROM task_10 WHERE text = :text";
$stmt = $pdo->prepare($query);
$stmt->execute([':text' => $text]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($result))
{
    $_SESSION['danger'] = 'Такая запись уже существует в БД.';
    header('Location: task_11.php');
    exit();
}

$query = "INSERT INTO task_10 (text) VALUES (:text)";
$stmt = $pdo->prepare($query);
$stmt->execute([':text' => $text]);

$_SESSION['success'] = 'Запись успешно добавлена';

header('Location: task_11.php');