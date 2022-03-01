<?php
require_once __DIR__ . '/../../app/Lib/pdoInit.php';
require_once __DIR__ . '/../../app/Lib/findUserByMail.php';
require_once __DIR__ . '/../../app/Lib/redirect.php';
require_once __DIR__ . '/../../app/Lib/Session.php';
require_once(__DIR__ . '/../../app/Lib/SessionKey.php');

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$session = Session::getInstance();
if (empty($email) || empty($password)) {
    $session->appendError( 'パスワードとメールアドレスを入力してください');
    redirect('./signin.php');
}

$users = findUserByMail($email);
// var_dump($password);
// var_dump($users['password']);
// die;
if (!password_verify($password,  $users['password'])) {
    $session->appendError('メールアドレスまたはパスワードが違います');
    redirect('./signin.php');
}

$formInputs = [
    'id' => $users['id'],
    'name' => $users['name'],
];
$formInputsKey = new SessionKey(SessionKey::FORM_INPUTS_KEY);
$session->setFormInputs($formInputsKey, $formInputs);
redirect('../index.php');

?>
