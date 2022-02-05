<?php
session_start();
$_SESSION['email'] = filter_input(INPUT_POST, "email");
$_SESSION['userName'] = filter_input(INPUT_POST, "name");

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

$email = filter_input(INPUT_POST, "email");
$name = filter_input(INPUT_POST, "name");
$password = filter_input(INPUT_POST, "password");
$confirmPassword = filter_input(INPUT_POST, "confirmPassword");
if (empty($password) || empty($confirmPassword)) $_SESSION['errors'][] = "パスワードを入力してください";
if ($password !== $confirmPassword) $_SESSION['errors'][] = "パスワードが一致しません";

if (!empty($_SESSION['errors'])) {
  header("Location: ./user/signup.php");
  exit;
}



$sql = "select * from users where email=:email";
$statement = $pdo->prepare($sql);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->execute();
$result = $statement->fetch();

$available = (!$result) ? true : false;
if (!$available) $_SESSION['errors'][] = "すでに登録済みのメールアドレスです";

if (!empty($_SESSION['errors'])) {
  header("Location: ./signup.php");
  exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users(id, name, email, password) VALUES (0, :name, :email, :password)";
$statement = $pdo->prepare($sql);
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
$statement->execute();

$_SESSION['registed'] = "登録できました。";
header("Location: ./signin.php");
exit;
