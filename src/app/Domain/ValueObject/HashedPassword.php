<?php
namespace App\Domain\ValueObject;

final class HashedPassword
{
    const INVALID_MESSAGE = 'パスワードの形式が正しくありません';

    private $value;

    public function __construct(string $value)
    {
        if ($value === false) {
            throw new Exception(self::INVALID_MESSAGE);
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function verify(InputPassword $inputPassword): bool
    {
        return password_verify($inputPassword->value(), $this->value);
    }
}
