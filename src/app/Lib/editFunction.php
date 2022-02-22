<?php
require_once __DIR__ . '/../Lib/pdoInit.php';

//自分が投稿した記事の編集
function editModify($id, $title, $contents)
{
    $pdo = pdoInit();
    $statement = $pdo->prepare(
        'UPDATE blogs SET title = :title, contents = :contents WHERE id = :id'
    );
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':contents', $contents, PDO::PARAM_STR);
    $statement->execute();
}

// 自分が投稿した記事のみ表示
function editScreen($id)
{
    $pdo = pdoInit();

    $sql = 'SELECT * FROM blogs WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $blog = $statement->fetch(PDO::FETCH_ASSOC);
    return $blog;
}
