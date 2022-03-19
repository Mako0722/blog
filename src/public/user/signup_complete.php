<?php
require_once __DIR__ . '/../../app/Infrastructure/Dao/UserDao.php';
require_once __DIR__ . '/../../app/Infrastructure/Redirect/redirect.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\InputPassword;
use App\Usecase\UseCaseInput\SignUpInput;
use App\Usecase\UseCaseInteractor\SignUpInteractor;




$email = filter_input(INPUT_POST, 'email');
$name = filter_input(INPUT_POST, 'name');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');

session_start();

if (empty($password) || empty($confirmPassword)) $_SESSION['errors'][] = "パスワードを入力してください";

if ($password !== $confirmPassword) $_SESSION['errors'][] = "パスワードが一致しません";

if(!empty($_SESSION['errors'])){
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['email'] =  $email;
    redirect('./signup.php');
}

$userName = new UserName($name);
$userEmail = new Email($email);
$userPassword = new InputPassword($password);
$useCaseInput = new SignUpInput($name, $email, $password);
$useCase = new SignUpInteractor($useCaseInput);
$useCaseOutput = $useCase->handler();
if ($useCaseOutput->isSuccess()) {
    $_SESSION['message'] = $useCaseOutput->message();
    redirect('./signin.php');
}  else {
    $_SESSION['errors'][] = $useCaseOutput->message();
    redirect('./signup.php');
}
