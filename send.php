<?php
session_start();

$text = $_POST['text'];

$pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");

$sql = "INSERT INTO texts (text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);

$message = "Ваше сообщение выводится тут - " . $text;
$_SESSION['message'] = $message;

header('Location: /index.php');
?>
