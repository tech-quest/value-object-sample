<?php 

final class SignInInteractor
{
    const FAILED_MESSAGE = "メールアドレスまたは<br />パスワードが間違っています";

    private $useCaseInput;

    public function __construct(SignInInput $useCaseInput)
    {
        $this->useCaseInput = $useCaseInput;
    }

    public function handler(): SignInOutput
    {
        $userDao = new UserDao();
        $user = $userDao->findByMail($this->useCaseInput->email());

        if (is_null($user)) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        if (!password_verify($this->useCaseInput->password()->value(), $user["password"])) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        return new SignInOutput(true, $user);
    }
}