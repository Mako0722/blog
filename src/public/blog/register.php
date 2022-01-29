<?php

$name = filter_input(INPUT_POST,'name');
$email = filter_input(INPUT_POST, 'email');
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog_app; charset=utf8mb4", $dbUserName, $dbPassword);


$sql = "SELECT * FROM  users WHERE email = :email";
$statement = $pdo->prepare($sql);
$statement->bindValue(':email', $email, PDO::PARAM_STR);
$statement->execute();
$member = $statement->fetch(PDO::FETCH_ASSOC);

if ($member['email'] === $email) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="signin.php">戻る</a>';
} else {
    //登録されていなければinsert
    // $sql = "INSERT INTO users(id, name, mail, password) VALUES (0, :name, :mail, :password)";
    // $statement = $pdo->prepare($sql);
    // $statement->bindValue(':name', $name);
    // $statement->bindValue(':mail', $mail);
    // $statement->bindValue(':password', $password);
    // $statement->execute();
    $sql = "INSERT INTO users(id, name, email, password) VALUES (0, :name, :email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':password', $password, PDO::PARAM_STR);
    $statement->execute();
    $msg = '会員登録が完了しました';
    $link = '<a href="signin.php">ログインページ</a>';
}
?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
