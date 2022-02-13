<?php

$id = filter_input(INPUT_POST, 'id');
$title = filter_input(INPUT_POST, 'title');
$contents = filter_input(INPUT_POST, 'contents');
require_once( __DIR__ . '/../app/Lib/editFunction.php');
require_once( __DIR__ . '/../app/Lib/redirect.php');

redirect('mypage.php');

?>
