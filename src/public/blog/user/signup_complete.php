<?php
session_start();
// $email = filter_input(INPUT_POST, 'email');
// $password = filter_input(INPUT_POST, 'password');
$_SESSION['email'] = filter_input(INPUT_POST, 'email');
$_SESSION['userName'] = filter_input(INPUT_POST, 'userName');

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

$mail = filter_input(INPUT_POST, 'email');
$userName = filter_input(INPUT_POST, 'userName');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');

if (empty($password) || empty($confirmPassword)) {
    $_SESSION['errors'][] = 'パスワードを入力してください';
}
if ($password !== $confirmPassword) {
    $_SESSION['errors'][] = 'パスワードが一致しません';
}

if (!empty($_SESSION['errors'])) {
    header('Location: ./user/signup.php');
}

// require_once('../utils/pdo.php');

$sql = 'SELECT * FROM users WHERE email = :email';
$statement = $pdo->prepare($sql);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->execute();

$result = $statement->fetch();

$available = !$result ? true : false;
if (!$available) {
    $_SESSION['errors'][] = 'すでに登録済みのメールアドレスです';
}

if (!empty($_SESSION['errors'])) {
    header('Location: ./signup.php');
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql =
    'INSERT INTO users(id, name, email, password) VALUES (0, :name, :email, :password)';
$statement = $pdo->prepare($sql);
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
$statement->execute();

$_SESSION['registed'] = '登録できました。';
header('Location: ./signin.php');
exit();

// $member = $statement->fetch(PDO::FETCH_ASSOC);
// $shouldPasswordCheck = !$member ? false : true;

// if (!password_verify($password, $member['password'])) {
//     $_SESSION['errors'] = 'メールアドレスまたは<br />パスワードが違います';
//     header('Location: ./signin.php');
//     exit();
// }

// $_SESSION['user_id'] = $member['id'];
// $_SESSION['user_name'] = $member['name'];
// header('Location: index.php');
// exit();
