<?php

namespace App\Adapter\QueryServise;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\UserDao;
use App\Domain\Entity\User;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\HashedPassword;

final class UserQueryServise
{
    private $userDao;

    public function __construct()
    {
        $this->userDao = new USerDao();
    }

    public function findByEmail(Email $email): ?User
    {
        $userMapper = $this->userDao->findByEmail($email);


        return $this->notExistsUser($userMapper)
        ? null
            : new User(
                new UserId($userMapper['id']),
                new UserName($userMapper['name']),
                new Email($userMapper['email']),
                new HashedPassword($userMapper['password'])
            );
    }

    private function notExistsUser(?array $user): bool
    {
        return is_null($user);
    }
}
