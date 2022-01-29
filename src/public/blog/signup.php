<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    </html>
    <h1>新規会員登録</h1>
    <form action="register.php" method="post">
    <div>
        <label>名前:<label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>メールアドレス:<label>
        <input type="text" name="email" required>
    </div>
    <div>
        <label>パスワード:<label>
        <input type="password" name="password" required>
    </div>
    <input type="submit" value="新規登録">
    </form>
    <p>すでに登録済みの方は<a href="">こちら</a></p>
</body>
