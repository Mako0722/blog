<?php
session_start();
$username = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}
if (isset($_SESSION['user_id'])) {
    //ログインしているとき
    $msg = 'こんにちは' . $username . 'さん';
    $link = '<a href="logout.php">ログアウト</a>';
} else {
    //ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login.php">ログイン</a>';
}

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog_app; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

$sql = 'SELECT * FROM blogs';
$statement = $pdo->prepare($sql);
$statement->execute();
$blogs = $statement->fetchAll(PDO::FETCH_ASSOC);

$my_blogs = [];
foreach ($blogs as $blog) {
    if ($user_id == $blog['user_id']) {
        $my_blogs[] = $blog;
    }
}
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
    <div>
        <h2>マイページ</h2>
    </div>


    <a href="create_form.php">新規作成</a>

    <?php foreach ($my_blogs as $my_blog): ?>
    <div class="row justify-content-center">
      <table class="table">
        <tr>
          <th><?php echo $my_blog['title']; ?></th>
          <th><?php echo $my_blog['contents']; ?></th>
          <th><?php echo $my_blog['created_at']; ?></th>
          <th><a href="myarticledetail.php?id=<?php echo $my_blog[
              'user_id'
          ]; ?>">記事詳細へ</a></th>
        </tr>
      </table>
    </div>
    <?php endforeach; ?>

</body>

</html>
