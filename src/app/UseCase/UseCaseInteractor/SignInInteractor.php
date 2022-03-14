<?php

final class SignInInteractor
{
    const FAILED_MESSAGE = "メールアドレスまたは<br />パスワードが間違っています";
    const SUCCESS_MESSAGE = "ログインしました";

    private $userDao;
    private $input;

    public function __construct(SignInInput $input)
    {
        $this->userDao = new UserDao();
        $this->input = $input;
    }

    public function handler(): SignInOutput
    {
        $user = $this->findUser();

        if ($this->notExistsUser($user)) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        if ($this->isInvalidPassword($user['password'])) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        $this->saveSession($user);

        return new SignInOutput(true, self::SUCCESS_MESSAGE);
    }

    private function findUser(): array
    {
        return $this->userDao->findByMail($this->input->email());
    }

    private function notExistsUser(?array $user): bool
    {
        return is_null($user);
    }

    private function isInvalidPassword(string $password): bool
    {
        return !password_verify($this->input->password(), $password);
    }

    private function saveSession(array $user): void
    {
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['name'] = $user['name'];
    }
}
