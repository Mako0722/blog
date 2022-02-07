<?php

session_start();
$user_id = $_SESSION['user_id'];
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

// $statement = $pdo->prepare(
//     'UPDATE blogs SET title = :title, contents = :contents WHERE user_id = :user_id'
// );
$sql = "DELETE FROM blogs where id = $id";
$statement = $pdo->prepare($sql);
$statement->execute();

header('Location: mypage.php');
?>
