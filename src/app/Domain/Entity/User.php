<?php
namespace App\Domain\Entity;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\HashedPassword;
use HashedPassword as GlobalHashedPassword;

final class User
{
    private $id;

    private $name;

    private $email;

    private $password;

    public function __construct(
        UserId $id,
        UserName $name,
        Email $email,
        HashedPassword $password
    ){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): HashedPassword
    {
        return $this->password;
    }
}
