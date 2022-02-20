<?php
require_once __DIR__ . '/../app/Lib/deletionFunction.php';
require_once __DIR__ . '/../app/Lib/redirect.php';

session_start();
$user_id = $_SESSION['user_id'];
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

deletionArticle($id);
redirect('mypage.php');
