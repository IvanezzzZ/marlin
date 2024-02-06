<?php
session_start();
require_once 'database.php';

$default_images = $_FILES['image'];
$changed_images = [];

//Меняем структуру массива с файлами в более удобную для работы
foreach ($default_images as $key_name => $value){
    foreach ($value as $key => $item) {
        $changed_images[$key][$key_name] = $item;
    }
}

function upload_file($tmp_name, $path, $pdo)
{

    if (!move_uploaded_file($tmp_name, $path))
    {
        $_SESSION['danger'] = 'Ошибка при загрузке изображения';
        header('Location: task_19.php');
        exit();
    } else {
        $query = "INSERT INTO images (path) VALUES (:path)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':path' => $path]);

        $_SESSION['success'] = 'Изображение успешно загружено';
        header('Location: task_19.php');
    }

}

foreach ($changed_images as $image){
    $tmp_name = $image['tmp_name'];
    $name = $image['name'];
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $new_name = uniqid('img_') . '.' . $extension;
    $path = 'images/' . $new_name;

    upload_file($tmp_name, $path, $pdo);
}
