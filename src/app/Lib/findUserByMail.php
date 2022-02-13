<?php
require_once(__DIR__ . '/../Lib/pdoInit.php');

function findUserByMail(string $email): ?array
{
    $pdo = pdoInit();

    $sql = "SELECT * FROM users WHERE email = :email";
	$statement = $pdo->prepare($sql);
	$statement->bindValue(':email', $email, PDO::PARAM_STR);
	$statement->execute();
	$user = $statement->fetch(PDO::FETCH_ASSOC);
	return ($user) ? $user : null;
}


// $sql = "select * from users where email=:email";
// $statement = $pdo->prepare($sql);
// $statement->bindValue(':email', $email, PDO::PARAM_STR);
// $statement->execute();
// $result = $statement->fetch();
