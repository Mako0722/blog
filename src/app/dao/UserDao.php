<?php
require_once __DIR__ . '/../dao/Dao.php';

final class UserDao extends Dao
{
    const TABLE_NAME = 'users';

    public function create(string $name, string $email, string $password): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = sprintf(
            'INSERT INTO %s (name, email, password) VALUES (:name, :email, :password)',
            self::TABLE_NAME
        );

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->execute();
    }

    public function findByEmail(string $email): ?array
    {
        $sql = sprintf(
            'SELECT * FROM %s WHERE email = :email',
            self::TABLE_NAME
        );

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return ($user === false) ? null : $user;
    }
}
?>
