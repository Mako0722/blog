<?php

session_start();
$user_id = $_SESSION['user_id'];

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

$statement = $pdo->prepare(
    'UPDATE blogs SET title = :title, contents = :contents WHERE user_id = :user_id'
);

$statement = $pdo->prepare('DELETE FROM blogs WHERE user_id = :user_id');
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>削除完了</title>
    </head>
    <body>
    <p>
        <a href="index.php">投稿一覧へ</a>
    </p>
    </body>
</html>
