<?php
require_once __DIR__ . '/../app/Lib/loginUser.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

loginUser($email);

if ($member['email'] === $email) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="signin.php">戻る</a>';
} else {
    loginAuthentication($name, $email, $password);
    $msg = '会員登録が完了しました';
    $link = '<a href="signin.php">ログインページ</a>';
}
?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
