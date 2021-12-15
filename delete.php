<?php
session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$id = $_GET['id'];
$name = $_GET['name'];

if (file_exists("img/new/" . $name)) {
    unlink("img/new/" . $name);
}


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