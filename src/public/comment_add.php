<?php
require_once __DIR__ . '/../app/Lib/commentFunction.php';
require_once __DIR__ . '/../app/Lib/redirect.php';

session_start();
$user_id = $_SESSION['user']['id'];
$blog_id = filter_input(INPUT_POST, 'id');
$commenter_name = filter_input(INPUT_POST, 'commenter_name');
$comments = filter_input(INPUT_POST, 'comments');

errorsInit($commenter_name, $comments);

commentPosts($user_id, $blog_id, $commenter_name, $comments);


redirect('detail.php?id=' . $blog_id);

?>
