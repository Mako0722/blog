<?php
require_once __DIR__ . '/../app/Lib/myPageFunction.php';
require_once __DIR__ . '/../app/Lib/Session.php';
require_once __DIR__ . '/../app/Lib/SessionKey.php';


$session = Session::getInstance();

$user_id = $_SESSION['formInputs']['userId'];

if (!isset($user_id)) {
    redirect('./user/signin.php');
}
$name = $_SESSION['formInputs']['name'];


if (isset($user_id)) {
    //ログインしているとき
    $msg = 'こんにちは' . $name . 'さん';
    $link = '<a href="./user/logout.php">ログアウト</a>';
} else {
    //ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login.php">ログイン</a>';
}

$blogs = articleMyList();

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
        <h1><?php echo $msg; ?></h1>
        <h2>マイページ</h2>
    </div>
    <a href="index.php">一覧ページへ</a><br>

    <a href="create_form.php">新規作成</a>

    <?php foreach ($my_blogs as $my_blog): ?>
    <div class="row justify-content-center">
      <table class="table">
        <tr>
          <th><?php echo $my_blog['title']; ?></th>
          <th><?php echo $my_blog['contents']; ?></th>
          <th><?php echo $my_blog['created_at']; ?></th>
          <th><a href="myarticledetail.php?id=<?php echo $my_blog[
              'id'
          ]; ?>">記事詳細へ</a></th>
        </tr>
      </table>
    </div>
    <?php endforeach; ?>

</body>

</html>
