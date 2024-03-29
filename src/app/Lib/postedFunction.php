<?php

require_once __DIR__ . '/../Lib/pdoInit.php';

function newPosted($user_id, $title, $contents)
{
    $pdo = pdoInit();

    $sql =
        'INSERT INTO `blogs`(`user_id`, `title`, `contents`) VALUES (:user_id,:title,:contents)';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':contents', $contents, PDO::PARAM_STR);
    $statement->execute();
}

?>
