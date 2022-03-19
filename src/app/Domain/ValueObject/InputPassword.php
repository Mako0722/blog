<?php
namespace App\Domain\ValueObject;
use Exception;

require_once(__DIR__ . '/HashedPassword.php');

final class InputPassword
{
    const PASSWORD_REGULAR_EXPRESSIONS = '/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i';

    const INVALID_MESSAGE = "パスワードの形式が正しくありません";

    private $value;

    public function __construct(string $value)
    {
        if ($this->isInvalid($value)){
            throw new Exception(self::INVALID_MESSAGE);
        }

        $this->value =$value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function hash(): HashedPassword
    {
        return new HashedPassword(password_hash($this->value, PASSWORD_DEFAULT));
    }

    private function isInvalid(string $value): bool
    {
        return !preg_match(self::PASSWORD_REGULAR_EXPRESSIONS, $value);
    }
}
