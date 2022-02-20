<?php

require_once __DIR__ . '/../app/Lib/articleList.php';

session_start();
$username = $_SESSION['user_name'];

if (!isset($_SESSION['user_id'])) {
    header('Location: ./user/signin.php');
    exit();
}

if (isset($_SESSION['user_id'])) {
    //ログインしているとき
    $msg = 'こんにちは' . $username . 'さん';
    $link = '<a href="./user/logout.php">ログアウト</a>';
} else {
    //ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login.php">ログイン</a>';
}


$blogs =articleList();
$blogs = orderSearch();

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/dist/output.css" rel="stylesheet">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>blog一覧</title>
</head>
<?php require_once __DIR__ . '/../app/Lib/header.php'; ?>

<body>
  <div>
    <a href="./index.php?search=<?php echo $search ??
        ''; ?>&order=asc">新しい順</a>
    <a href="./index.php?search=<?php echo $search ??
        ''; ?>&order=desc">古い順</a>
  </div>

  <div class="blogs__wraper bg-green-300 py-20 px-20">
    <div class="ml-8 mb-12">
      <h2 class="mb-2 px-2 text-6xl font-bold text-green-800">blog一覧</h2>
    </div>
    <form action="./index.php" method="get">
      <div class="ml-8 mb-6">
        <input type="textarea" name="searchWord" placeholder="キーワードを入力" value="<?php echo $search ??
            ''; ?>">
        <input type="submit" value="検索" />
      </div>
      <div class="ml-8">
        <label>
          <input type="radio" name="order" value="desc" class="">
          <span>新着順</span>
        </label>
        <label>
          <input type="radio" name="order" value="asc" class="">
          <span>古い順</span>
        </label>
      </div>
    </form>
  </div>


  <h1><?php echo $msg; ?></h1>

  <?php foreach ($blogs as $blog): ?>
    <div class="row justify-content-center">
      <table class="table">
        <tr>
          <th><?php echo $blog['title']; ?></th>
          <th><?php echo $blog['contents']; ?></th>
          <th><?php echo $blog['created_at']; ?></th>
          <th><a href="detail.php?id=<?php echo $blog['id']; ?>">詳細</a></th>
        </tr>
      </table>
    </div>
  <?php endforeach; ?>

</body>

</html>
