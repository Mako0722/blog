<?php
require_once __DIR__ . '/../Lib/pdoInit.php';

function loginUser($email)
{
    $pdo = pdoInit();

    $sql = 'SELECT * FROM users WHERE email = :email';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $member = $statement->fetch(PDO::FETCH_ASSOC);
    return $member;
}

function loginAuthentication($name, $email, $password)
{
    $pdo = pdoInit();
    $sql =
        'INSERT INTO users(id, name, email, password) VALUES (0, :name, :email, :password)';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':password', $password, PDO::PARAM_STR);
    $statement->execute();
}

?>
