<?php
session_start();

$text = $_POST['text'];

$pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");

$sql = "SELECT * FROM texts WHERE text=:text";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

if (!empty($task)) {
    $message = "You should check in on some of those fields below.";
    $_SESSION['danger'] = $message;

    header("Location: /index.php");
    exit;
}

$sql = "INSERT INTO texts (text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);

$message = "The entry has been successfully created.";
$_SESSION['success'] = $message;

header('Location: /index.php');
?>
