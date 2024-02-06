<?php
require_once 'database.php';

$text = $_POST['text'];

$query = "INSERT INTO task_10 (text) VALUES (:text)";
$stmt = $pdo->prepare($query);
$stmt->execute([':text' => $text]);

header('Location: task_10.php');