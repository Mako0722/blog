<?php
require_once __DIR__ . '/../../app/Lib/pdoInit.php';
require_once __DIR__ . '/../../app/Lib/findUserByMail.php';
require_once __DIR__ . '/../../app/Lib/redirect.php';
require_once __DIR__ . '/../../app/Lib/Session.php';

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$session = Session::getInstance();
if (empty($email) || empty($password)) {
    $session->appendError( 'パスワードとメールアドレスを入力してください');
    redirect('signin.php');
}

$users = findUserByMail($email);

if (!password_verify($password,  $users['password'])) {
    $_SESSION['errors'] = 'メールアドレスまたはパスワードが違います';
    redirect('signin.php');
}

$formInputs = [
    'userId' => $users['id'],
    'userName' => $users['user_name'],
];
$session->setFormInputs($formInputs);
redirect('../index.php');

?>
