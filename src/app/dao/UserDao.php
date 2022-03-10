<?php
final class UserDao
{
    const TABLE_NAME = 'users';
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:dbname=blog;host=mysql;charset=utf8', 'root', 'password');
        } catch (PDOException $e) {
            exit('DB接続エラー:' . $e->getMessage());
        }
    }

    public function create(string $name, string $email, string $password): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = sprintf("INSERT INTO %s (name, email, password) VALUES (:name, :email, :password)",self::TABLE_NAME);

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->execute();
    }

    public function findByEmail(string $email): ?array
    {
        $sql = sprintf("SELECT * FROM %s WHERE email = :email",self::TABLE_NAME);

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return ($user) ? $user : null;
    }
}
?>
