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
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>login</title>
</head>

<body class="bg-indigo-200 w-full h-screen flex justify-center items-center">
  <div class="w-96  bg-white pt-10 pb-10 rounded-xl">
    <div class="w-60 m-auto text-center">
      <h2 class="text-2xl mb-5">会員登録</h2>
      <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
      <?php endforeach; ?>
      <form action="./signup_complete.php" method="POST">
        <p>
          <input class="border-2 border-gray-300 mb-5 w-full" placeholder="User name" type=“text” name="userName" required value="<?php if (isset($_SESSION['userName'])) echo $_SESSION['userName'] ?>">
        </p>
        <p><input  class="border-2 border-gray-300 mb-5 w-full" placeholder="Email" type=“mail” name="mail" required value="<?php if (isset($_SESSION['mail'])) echo $_SESSION['mail'] ?>"></p>
        <p><input class="border-2 border-gray-300 mb-5 w-full" placeholder="Password" type="password" name="password"></p>
        <p><input class="border-2 border-gray-300 mb-5 w-full" placeholder="Password確認" type="password" name="confirmPassword"></p>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mb-5 w-full" type="submit">アカウント作成</button>
      </form>
      <a class="text-blue-500" href="./signin.php">ログイン画面へ</a>
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
