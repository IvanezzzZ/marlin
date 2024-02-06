<?php
session_start();
require_once 'database.php';

$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];

$extension = pathinfo($name, PATHINFO_EXTENSION);
$new_name = time() . '.' . $extension;
$path = 'images/' . $new_name;

if (!move_uploaded_file($tmp_name, $path))
{
    $_SESSION['danger'] = 'Ошибка при загрузке изображения';
    header('Location: task_18.php');
    exit();
} else {
    $query = "INSERT INTO images (path) VALUES (:path)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':path' => $path]);

    $_SESSION['success'] = 'Изображение успешно загружено';
    header('Location: task_18.php');
}

