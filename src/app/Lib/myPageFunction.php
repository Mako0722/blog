<?php
require_once __DIR__ . '/../Lib/pdoInit.php';

function articleMy($id)
{
    $pdo = pdoInit();
    $sql = 'SELECT * FROM blogs WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $blog = $statement->fetch(PDO::FETCH_ASSOC);
    return $blog;
}

function articleMyList()
{
    $pdo = pdoInit();
    $sql = 'SELECT * FROM blogs';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $blogs = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $blogs;
}

?>
