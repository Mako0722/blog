<?php
require_once __DIR__ . '/../../app/dao/UserDao.php';
require_once __DIR__ . '/../../app/utils/redirect.php';
require_once(__DIR__ . '/../../app/UseCase/UseCaseInput/SignInInput.php');
require_once(__DIR__ . '/../../app/UseCase/UseCaseInteractor/SignInInteractor.php');
require_once(__DIR__ . '/../../app/UseCase/UseCaseOutput/SignInOutput.php');
require_once(__DIR__ . '/../../app/ValueObject/Email.php');
require_once(__DIR__ . '/../../app/ValueObject/InputPassword.php');

session_start();
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

if (empty($email) || empty($password)) {
    $_SESSION['errors'][] = 'パスワードとメールアドレスを入力してください';
    redirect('./signin.php');
}

$userEmail = new Email($email);
$inputPassword = new InputPassword($password);
$useCaseInput = new SignInInput($email, $password);
$useCase = new SignInInteractor($useCaseInput);
$useCaseOutput = $useCase->handler();

if ($useCaseOutput->isSuccess()) {
    redirect("../index.php");
} else {
    $_SESSION['errors'][] = $useCaseOutput->message();
    redirect("./user/signin.php");
}
