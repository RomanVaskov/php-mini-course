<?php
$pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");
$sql = "DELETE FROM students WHERE id=:id";
$statement = $pdo->prepare($sql);
$statement->execute($_GET);

header('Location: /index.php');
?>