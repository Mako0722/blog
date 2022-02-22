<?php
require_once __DIR__ . '/../Lib/pdoInit.php';

function commentPosts($user_id, $blog_id, $commenter_name, $comments)
{
    $pdo = pdoInit();
    $sql =
        'INSERT INTO `comments`(`user_id`, `blog_id`, `commenter_name`,`comments`) VALUES (:user_id,:blog_id,:commenter_name,:comments)';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindValue(':blog_id', $blog_id, PDO::PARAM_INT);
    $statement->bindValue(':commenter_name', $commenter_name, PDO::PARAM_STR);
    $statement->bindValue(':comments', $comments, PDO::PARAM_STR);
    $statement->execute();
}

function errorsInit($commenter_name, $comments)
{
    //エラー
    if (empty($commenter_name)) {
        exit('コメント名を入力してください');
    }
    if (empty($comments)) {
        exit('コメントを入力してください');
    }
}

function commentDisplaySort($id)
{
    $pdo = pdoInit();

    $sql = 'SELECT * FROM blogs WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $blog = $statement->fetch(PDO::FETCH_ASSOC);
    return $blog;
}

function isSort($commenter_name, $my_comments)
{
    $pdo = pdoInit();

    $sql = 'SELECT * FROM comments';
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
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    $my_comments = [];
    foreach ($comments as $comment) {
        if ($comment['blog_id'] == $blog['id']) {
            $my_comments[] = $comment;
        }
    }
    if (empty($commenter_name) || empty($comments)) {
        $errors[] = '「コメント名」「コメント」の記入されていません！';
    }
    return $comments;
}

?>
