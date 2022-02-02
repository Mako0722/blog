<?php
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

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=blog; charset=utf8mb4',
    $dbUserName,
    $dbPassword
);

$sql = 'SELECT * FROM blogs';
$statement = $pdo->prepare($sql);
$statement->execute();
$blogs = $statement->fetchAll(PDO::FETCH_ASSOC);


if (!empty($_GET['searchWord'])) {
    $escapedKeyword = '';
    $searchWord = filter_input(
        INPUT_GET,
        'searchWord',
        FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
    $sql .= ' where title like :keyword';
    $pattern = '/%/';
    if (preg_match($pattern, $searchWord)) {
        $escapedKeyword = str_replace('%', '\%', $search);
        $searchKeyword = '%' . $escapedKeyword . '%';
    } else {
        $searchKeyword = '%' . $searchWord . '%';
    }
}

$sortMode = '';
if (!empty($_GET['order'])) {
    $sortMode = filter_input(
        INPUT_GET,
        'order',
        FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
}
if ($sortMode == 'asc' || $sortMode == 'desc') {
    $sql = $sql . " order by created_at $sortMode";
}

$statement = $pdo->prepare($sql);
if (!empty($_GET['searchWord'])) {
    $statement->bindValue(':keyword', $searchKeyword, PDO::PARAM_STR);
}
$statement->execute();
$blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/dist/output.css" rel="stylesheet">
  <title>blog一覧</title>
</head>

<body>
  <div>
    <h2>blog一覧</h2>
  </div>
  <form method="get" action="./index.php">
    <div>
      <input type="textarea" name="searchWord" placeholder="キーワードを入力" value="<?php echo $search ??
          ''; ?>">
      <button type="submit">検索</button>
    </div>
  </form>
  <div>
    <a href="./index.php?search=<?php echo $search ??
        ''; ?>&order=asc">新しい順</a>
    <a href="./index.php?search=<?php echo $search ??
        ''; ?>&order=desc">古い順</a>
  </div>



  <h1><?php echo $msg; ?></h1>
  <?php echo $link; ?><br>



  <a href="mypage.php">マイページ</a>

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
