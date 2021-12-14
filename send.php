<?php
session_start();

for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
    upload_file($_FILES['file']['name'][$i], $_FILES['file']['tmp_name'][$i]);
}

function upload_file($filename, $tmp_name) {
    $result = pathinfo($filename);
    $extension = $result['extension'];

    $filename = uniqid() . "." . $extension;

    $pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");

    $sql = "INSERT INTO images (image) VALUES (:image)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['image' => $filename]);

    move_uploaded_file($tmp_name, 'img/new/' . $filename);
}

$pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");

$sql = "SELECT * FROM images";
$statement = $pdo->prepare($sql);
$statement->execute();
$images = $statement->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['images'] = $images;

header("Location: /index.php");