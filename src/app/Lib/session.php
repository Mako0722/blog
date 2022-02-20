<?php

function errorsInit(): array
{
    //エラー
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);
    return $errors;
}

function registedInit(): string
{
    //登録済み
    $registed = $_SESSION['registed'] ?? '';
    $_SESSION['register'] = '';
    return $registed;
}

function appendError(string $errorMessage): void
{
    //エラーメッセージ
    $_SESSION['errors'][] = $errorMessage;
}

?>
