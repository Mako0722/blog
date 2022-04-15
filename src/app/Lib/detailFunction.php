<?php
require_once __DIR__ . '/../Lib/pdoInit.php';

function detailDisplay($id)
{
    $pdo = pdoInit();

    $sql = 'SELECT * FROM blogs WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $blog = $statement->fetch(PDO::FETCH_ASSOC);
    return $blog;
}

function commentsDisplay()
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
    return $comments;
}
?>
