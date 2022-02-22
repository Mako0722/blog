<?php
require_once __DIR__ . '/../../app/Lib/loginUser.php';
require_once __DIR__ . '/../../app/Lib/redirect.php';

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

session_start();
if (empty($email) || empty($password)) {
    $_SESSION['errors'] = 'パスワードとメールアドレスを入力してください';
    redirect('signin.php');
}

$member = loginUser($email);
$shouldPasswordCheck = !$member ? false : true;

if (!password_verify($password, $member['password'])) {
    $_SESSION['errors'] = 'メールアドレスまたはパスワードが違います';
    redirect('signin.php');
}

$_SESSION['user_id'] = $member['id'];
$_SESSION['user_name'] = $member['name'];

redirect('../index.php');

?>
