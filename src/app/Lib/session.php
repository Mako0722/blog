<?php
// 1回目であれば自身のインスタンスを生成し、返す。
// セッション処理の開始をする。
// @return self
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

    /**
      * セッションに保存されているエラー文を返す。
      * セッションに保存されているエラー文を削除する。
      *
      *
      */
    public function popAllErrors(): array
    {
        $errors = $_SESSION[self::ERROR_KEY] ?? [];
        $this->clear(self::ERROR_KEY);
        return $errors;
    }

    /**
      * エラー文がセッションに保存されていたら「true」を返す。
      * エラー文がセッションに保存されていなければ「false」を返す。
      *
      *
      */
    public function existsErrors(): bool
    {
        return !empty($_SESSION[self::ERROR_KEY]);
    }

    /**
      * 引数で受け取ったキーのセッションに保存されているデータを削除する。
      *
      */
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

?>
