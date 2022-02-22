<?php
require_once __DIR__ . '/../Lib/pdoInit.php';

function deletionArticle($id)
{
    $pdo = pdoInit();
    $sql = "DELETE FROM blogs where id = $id";
    $statement = $pdo->prepare($sql);
    $statement->execute();
}
