<?php

session_start();
$user_id = $_SESSION['user_id'];
$blog_id = filter_input(INPUT_POST, 'id');
$commenter_name = filter_input(INPUT_POST, 'commenter_name');
$comments = filter_input(INPUT_POST, 'comments');

if (empty($commenter_name)) {
    exit('コメント名を入力してください');
}

if (empty($comments)) {
    exit('コメントを入力してください');
}

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

$sql =
    'INSERT INTO `comments`(`user_id`, `blog_id`, `commenter_name`,`comments`) VALUES (:user_id,:blog_id,:commenter_name,:comments)';
$statement = $pdo->prepare($sql);
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$statement->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);
$statement->bindValue(':commenter_name', $commenter_name, PDO::PARAM_STR);
$statement->bindValue(':comments', $comments, PDO::PARAM_STR);
$statement->execute();

header('Location: detail.php?id=' . $blog_id);

?>
