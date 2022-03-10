<?php
require_once __DIR__ . '/../app/Lib/detailFunction.php';

require_once __DIR__ . '/../app/Lib/Session.php';
$session = Session::getInstance();


$id = filter_input(INPUT_GET, 'id');

$blog = detailDisplay($id);

$comments = commentsDisplay();
$my_comments = [];
foreach ($comments as $comment) {
    if ($comment['blog_id'] == $blog['id']) {
        $my_comments[] = $comment;
    }
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>ブログ詳細</h2>
    <th><?php echo $blog['title']; ?></th>
    <th><?php echo $blog['contents']; ?></th>
    <th><?php echo $blog['created_at']; ?></th><br>
    <a href="index.php">投稿一覧へ</a>
    <div class="comment_confirmation">
        <p class="modal_title">この投稿にコメントしますか？</p>
        <th>
            <p class="post_content">
            <form action="comment_add.php" method="post">
                <div class="form-group">
                    <label>コメント名</label><br>
                    <p>
                        <input type="text" id="commenter_name" name="commenter_name" class="form-control" placeholder="コメント名">
                    </p>
                </div>
                <input type="hidden" name="id" value='<?php print $blog[
                    'id'
                ]; ?>'>
                <div class="form-group">
                    <p>
                        <labe>コメント内容</labe><br>
                            <input type="text" id="comments" name="comments" class="form-control" placeholder="本文">
                </div>
                <div class="form-group">
                    <button type="submit" value="コメント" class="btn-primary" name="button">コメントする</button>
                </div>
            </form>
        </th>
    </div>
    <div>
        <a href="./detail.php?id=<?php echo $id ??
            ''; ?>&order=desc">新しい順</a>
        <a href="./detail.php?id=<?php echo $id ?? ''; ?>&order=asc">古い順</a>
    </div>
    <?php foreach ($my_comments as $my_comment): ?>
        <div class="row justify-content-center">
            <table class="table">
                <tr>
                    <th><?php echo $my_comment['commenter_name']; ?></th>
                    <th><?php echo $my_comment['comments']; ?></th>
                    <th><?php echo $my_comment['created_at']; ?></th>
                </tr>
            </table>
        </div>
    <?php endforeach; ?>
</body>

</html>
