<?php
session_start();
$user_id =$_SESSION['user_id'];
// $username = $_SESSION['user_name'];

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}
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
    <div class="row justify-content-center">
        <form action="create.php" method="post">
            <div class="form-group">
                <h2><label>blog記事登録</label></h2>
            </div>
            <div class="form-group">
                <label>タイトル</label>
                <input type="text" id="title" name="title" class="form-control"  placeholder="タイトル">
            </div>
            <div class="form-group">
                <label>本文</label>
                <input type="text" id="contents" name="contents" class="form-control" placeholder="本文">
            </div>
            <div class="form-group">
                <button type="submit" value="送信" class="btn-primary" name="button">送信</button>
            </div>
        </form>
    </div>
</body>
</html>
