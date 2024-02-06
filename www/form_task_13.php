<?php
session_start();

$_SESSION['message'] = $_POST['text'];

header('Location: task_13.php');