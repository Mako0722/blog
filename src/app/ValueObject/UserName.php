<?php

final class UserName
{
    const INVALID_MESSAGE = 'ユーザ名は20文字以下でお願いします';

    private $value;


    public function __construct(string $value)
    {
        if ($this->isInvalid($value)) {
        throw new Exception(self::INVALID_MESSAGE);
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function isInvalid(string $value): bool
    {
        return mb_strlen($value) > 20;
    }
}
