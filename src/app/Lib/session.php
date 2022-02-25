<?php
/**
  * セッションの操作を行うクラス
  */
final class Session
{

    private const ERROR_KEY = 'errors';
    private const FORM_INPUTS_KEY = 'formInputs';
    private const MESSAGE_KEY = 'message';
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        self::start();
        return self::$instance;
    }

    private static function start(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function appendError(string $errorMessage): void
    {
        $_SESSION[self::ERROR_KEY][] = $errorMessage;
    }

    public function popAllErrors(): array
    {
        $errors = $_SESSION[self::ERROR_KEY] ?? [];
        $this->clear(self::ERROR_KEY);
        return $errors;
    }

    public function existsErrors(): bool
    {
        return !empty($_SESSION[self::ERROR_KEY]);
    }

    public function clear(string $sessionKey): void
    {
        unset($_SESSION[$sessionKey]);
    }

    public function setFormInputs(array $formInputs): void
    {
        foreach ($formInputs as $key => $formInput) {
            $_SESSION[self::FORM_INPUTS_KEY][$key] = $formInput;
        }
    }

    public function getFormInputs(): array
    {
        return $_SESSION[self::FORM_INPUTS_KEY] ?? [];
    }


    public function setMessage($message): void
    {
        $_SESSION[self::MESSAGE_KEY] = $message;
    }

    public function getMessage(): string
    {
        $message = $_SESSION[self::MESSAGE_KEY] ?? '';
        $this->clear(self::MESSAGE_KEY);
        return $message;
    }
}
