<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ./user/signin.php");
  exit;
}
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

</body>

</html>
