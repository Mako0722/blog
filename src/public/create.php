<?php
require_once __DIR__ . '/../app/Lib/postedFunction.php';
require_once __DIR__ . '/../app/Lib/redirect.php';
require_once __DIR__ . '/../app/Lib/Session.php';

$session = Session::getInstance();
$user_id = $_SESSION['formInputs']['id'];
$title = filter_input(INPUT_POST, 'title');
$contents = filter_input(INPUT_POST, 'contents');


if (empty($title)) {
    exit('タイトルを入力してください');
}

if (mb_strlen($title) > 191) {
    exit('タイトルは191文字以内にしてください');
}

if (empty($contents)) {
    exit('タイトルを入力してください');
}

newPosted($user_id, $title, $contents);

redirect('index.php');

?>
