<?php
session_start();
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog_app; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

$sql = 'SELECT * FROM users WHERE email = :email';
$statement = $pdo->prepare($sql);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->execute();
$member = $statement->fetch(PDO::FETCH_ASSOC);
$shouldPasswordCheck = !$member ? false : true;

if (!password_verify($password, $member['password'])) {
    $_SESSION['errors'] = 'メールアドレスまたは<br />パスワードが違います';
    header('Location: ./signin.php');
    exit();
}

$_SESSION['user_id'] = $member['id'];
$_SESSION['user_name'] = $member['name'];
header('Location: index.php');
exit();
