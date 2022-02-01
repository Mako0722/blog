<?php
$mail = filter_input(INPUT_POST, 'mail');
$password = filter_input(INPUT_POST, 'password');

session_start();
if (empty($mail) || empty($password)) {
    $_SESSION['errors'] = "パスワードとメールアドレスを入力してください";
    header("Location: ./signin.php");
    exit;
}

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

$sql = 'SELECT * FROM users WHERE mail = :mail';
$statement = $pdo->prepare($sql);
$statement->bindValue(':mail', $mail, PDO::PARAM_STR);
$statement->execute();
$member = $statement->fetch(PDO::FETCH_ASSOC);
$shouldPasswordCheck = (!$member) ? false : true;


if (!password_verify($password, $member["password"])) {
    $_SESSION['errors'] = "メールアドレスまたはパスワードが違います";
    header("Location: ./signin.php");
    exit;
}

$_SESSION['id'] = $member['id'];
$_SESSION['user_name'] = $member['user_name'];
header("Location: ./index.php");
exit;

?>
