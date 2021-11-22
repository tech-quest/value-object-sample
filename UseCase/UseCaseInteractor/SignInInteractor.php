<?php 

final class SignInInteractor
{
    const FAILED_MESSAGE = "メールアドレスまたは<br />パスワードが間違っています";

    private $userDao;
    private $useCaseInput;

    public function __construct(SignInInput $useCaseInput)
    {
        $this->userDao = new UserDao();
        $this->useCaseInput = $useCaseInput;
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

        return new SignInOutput(true, $user);
    }

    private function findUser(): array
    {
        return $userDao->findByMail($this->useCaseInput->email());
    }

    private function notExistsUser(?array $user): bool
    {
        return is_null($user);
    }

    private function isInvalidPassword(string $password): bool
    {
        return !password_verify($this->useCaseInput->password(), $password);
    }
}