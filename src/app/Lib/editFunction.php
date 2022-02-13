<?php
require_once( __DIR__ . '/../Lib/pdoInit.php');
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
