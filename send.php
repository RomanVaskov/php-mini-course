<?php
$text = $_POST['text'];
$pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");
$sql = "INSERT INTO texts (text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);

header('Location: /index.php');
?>
