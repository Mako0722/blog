<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <h2>ログイン</h2>
        <form action="signin_complete.php" method="post">
            <p><input type=“text” name="email" type="email" required placeholder="Email" value="<?php if (
                                                                                                    isset($_SESSION['email'])
                                                                                                ) {
                                                                                                    echo $_SESSION['email'];
                                                                                                } ?>"></p>

            <p><input type="password" placeholder="Password" name="password"></p>
            <button type="submit">ログイン</button>
        </form>
    </div>
    <a href="signup.php">新規登録ページへ</a>
</body>

</html>
