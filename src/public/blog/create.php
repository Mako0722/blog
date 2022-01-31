<?php
session_start();
$user_id = $_SESSION['user_id'];
$title = filter_input(INPUT_POST, 'title');
$contents = filter_input(INPUT_POST, 'contents');

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

if (empty($title)) {
    exit('タイトルを入力してください');
}

if (mb_strlen($title) > 191) {
    exit('タイトルは191文字以内にしてください');
}

if (empty($contents)) {
    exit('タイトルを入力してください');
}

$sql =
    'INSERT INTO `blogs`(`user_id`, `title`, `contents`) VALUES (:user_id,:title,:contents)';
$statement = $pdo->prepare($sql);
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$statement->bindValue(':title', $title, PDO::PARAM_STR);
$statement->bindValue(':contents', $contents, PDO::PARAM_STR);
$statement->execute();

header('Location: index.php');

?>
