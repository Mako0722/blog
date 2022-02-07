<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
</head>

<body>
  <div>
    <div>
      <h2>会員登録</h2>
      <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
      <?php endforeach; ?>
      <form action="./signup_complete.php" method="post">
        <p>
          <input placeholder="User name" type=“text” name="name" required value="<?php if (isset($_SESSION['userName'])) echo $_SESSION['userName'] ?>">
        </p>
        <p><input placeholder="Email" type=“mail” name="email" required value="<?php if (isset($_SESSION['mail'])) echo $_SESSION['mail'] ?>"></p>
        <p><input placeholder="Password" type="password" name="password"></p>
        <p><input placeholder="Password確認" type="password" name="confirmPassword"></p>
        <button type="submit">アカウント作成</button>
      </form>
      <a href="./signin.php">ログイン画面へ</a>
    </div>
  </div>
</body>

</html>




<!-- <body>
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
    <p>すでに登録済みの方は<a href="signin.php">こちら</a></p>
</body> -->
