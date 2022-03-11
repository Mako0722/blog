<?php
require_once __DIR__ . '/../../app/dao/UserDao.php';
require_once __DIR__ . '/../../app/utils/redirect.php';

session_start();
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

if (empty($email) || empty($password)) {
    $_SESSION['errors'][] = 'パスワードとメールアドレスを入力してください';
    redirect('./signin.php');
}

$userDao = new UserDao();
$member = $userDao->findByEmail($email);

if (!password_verify($password, $member['password'])) {
    $_SESSION['errors'][] = 'メールアドレスまたは<br />パスワードが違います';
    redirect('./signin.php');
}

$_SESSION['formInputs']['userId'] = $member['id'];
$_SESSION['formInputs']['name'] = $member['name'];
redirect('../index.php');
