<?php

session_start();
$id = filter_input(INPUT_GET, 'id');

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

$sql = 'SELECT * FROM blogs WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$blog = $statement->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="mypage.php">マイページへ</a><br>
    <h2>ブログ詳細</h2>
    <th><?php echo $blog['title']; ?></th>
    <th><?php echo $blog['contents']; ?></th>
    <th><?php echo $blog['created_at']; ?></th><br>
        <th><a href="edit_form.php?id=<?php echo $blog['id']; ?>">編集</a></th>
        <th><a href="delete.php?id=<?php echo $blog['id']; ?>">削除</a></th>
</body>
</html>
