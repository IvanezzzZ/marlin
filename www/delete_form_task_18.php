<?php
require_once 'database.php';
$id = $_GET['id'];

$query = "SELECT * FROM images WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$image = $result['path'];

if (file_exists($image))
{
    unlink($image);
}

$query = "DELETE FROM images WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);

header('Location: task_18.php');
