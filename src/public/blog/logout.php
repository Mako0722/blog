<?php
session_start();
$_SESSION = []; //セッションの中身をすべて削除
session_destroy();

//セッションを破壊
?>

<p>ログアウトしました。</p>
<a href="signin.php">ログインへ</a>
