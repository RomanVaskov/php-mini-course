<?php
$pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");
$sql = "UPDATE students SET first_name=:first_name, last_name=:last_name, username=:username WHERE id=:id";
$statement = $pdo->prepare($sql);
$statement->execute($_POST);
$user = $statement->fetch(PDO::FETCH_ASSOC);

header('Location: /index.php');
?>