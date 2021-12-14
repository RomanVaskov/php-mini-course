<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO("mysql:host=localhost;dbname=php_course;", "root", "");

$sql = "SELECT * FROM accounts WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

if (empty($task)) {
    $message = "Неверный логин или пароль.";
    $_SESSION['danger'] = $message;

    header("Location: /index.php");
    exit;
} elseif (!password_verify($password, $task['password']) || $task['email'] !== $email) {
    $message = "Неверный логин или пароль.";
    $_SESSION['danger'] = $message;

    header("Location: /index.php");
    exit;
} elseif (password_verify($password, $task['password']) && $task['email'] == $email) {
    $message = "Здравствуйте, " . $task['email'];
    $_SESSION['message'] = $message;

    header('Location: /user.php');
}