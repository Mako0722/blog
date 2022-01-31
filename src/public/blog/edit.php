<?php

$user_id = filter_input(INPUT_POST, 'user_id');
$title = filter_input(INPUT_POST, 'title');
$contents = filter_input(INPUT_POST, 'contents');

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
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$statement->bindValue(':title', $title, PDO::PARAM_STR);
$statement->bindValue(':contents', $contents, PDO::PARAM_STR);
$statement->execute();

header('Location:detail.php');

?>
