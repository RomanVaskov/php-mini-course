<?php
session_start();

$id = $_GET['id'];
$name = $_GET['name'];
unlink("img/new/" . $name);

$pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");
$sql = "DELETE FROM images WHERE id=:id";
$statement = $pdo->prepare($sql);
$statement->execute(['id' => $id]);

$sql = "SELECT * FROM images";
$statement = $pdo->prepare($sql);
$statement->execute();
$images = $statement->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['images'] = $images;

header('Location: /index.php');
?>