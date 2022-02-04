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

$sql = 'SELECT * FROM blogs WHERE user_id = :user_id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$blog = $statement->fetch(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<body>
    <div class="row justify-content-center">
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value=<?php echo $blog['id']; ?>>
            <div class="form-group">
                <label>編集</label>
            </div>
            <div class="form-group">
                <label>タイトル</label>
                <input type="text" name="title" class="form-control" value=<?php echo $blog[
                    'title'
                ]; ?>>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="contents" class="form-control" value=<?php echo $blog[
                    'contents'
                ]; ?>>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-primary" name="sava">更新</button>
            </div>
        </form>
    </div>
</body>
</body>
</html>
