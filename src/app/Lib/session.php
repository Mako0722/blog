<?php
require_once(__DIR__ . '/SessionKey.php');

/**
  * セッションの操作を行うクラス
  */
final class Session
{

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
        $_SESSION[SessionKey::ERROR_KEY][] = $errorMessage;
    }

    public function popAllErrors(): array
    {
        $errors = $_SESSION[SessionKey::ERROR_KEY] ?? [];
        $errorKey = new SessionKey(SessionKey::ERROR_KEY);
        $this->clear($errorKey);
        return $errors;
    }

    public function existsErrors(): bool
    {
        return !empty($_SESSION[SessionKey::ERROR_KEY]);
    }

    public function clear(SessionKey $sessionKey): void
    {
        unset($_SESSION[$sessionKey->value()]);
    }

    public function setFormInputs(SessionKey $sessionKey, $value): void
	{
		$_SESSION[$sessionKey->value()] = $value;
	}

	public function getFormInputs(): array
	{
		return $_SESSION[SessionKey::FORM_INPUTS_KEY] ?? [];
	}

	public function setMessage(SessionKey $sessionKey, $message): void
	{
		$_SESSION[$sessionKey->value()] = $message;
	}

	public function getMessage(): string
	{
		$message = $_SESSION[SessionKey::MESSAGE_KEY] ?? "";
		$messageKey = new SessionKey(SessionKey::MESSAGE_KEY);
		$this->clear($messageKey);
		return $message;
	}
}
