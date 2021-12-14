<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");

$sql = "SELECT * FROM accounts WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

if (!empty($task)) {
    $message = "Этот эл адрес уже занят другим пользователем.";
    $_SESSION['danger'] = $message;

    header("Location: /index.php");
    exit;
}

$sql = "INSERT INTO accounts (email,password) VALUES (:email,:password)";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

$message = "Вы успешно зарегистрировались";
$_SESSION['success'] = $message;

header('Location: /index.php');
?>
