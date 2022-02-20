<?php

function pdoInit(): PDO
{
    //db接続
    //db接続
    $dbUserName = 'root';
    $dbPassword = 'password';
    $pdo = new PDO(
        'mysql:host=mysql; dbname=blog; charset=utf8mb4',
        $dbUserName,
        $dbPassword
    );
    return $pdo;
}
