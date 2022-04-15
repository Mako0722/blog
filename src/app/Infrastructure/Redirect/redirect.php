<?php
namespace App\Infrastructure\Redirect;

final class Redirect
{
    public static function handler(string $path): void
    {
        header('Location:' . $path);
        exit();
    }
}
