<?php 

final class SignInInteractor
{
    public function __construct(SignInUseCaseInput $useCaseInput)
    {
        $this->useCaseInput = $useCaseInput;
    }

    public function handler(): SignInUseCaseOutput
    {
        $userDao = new UserDao();
        $user = $userDao->findByMail($this->useCaseInput->email());

        if (is_null($user)) {
            return new SignInUseCaseOutput(false);
        }

        if (!password_verify($this->useCaseInput->password(), $user["password"])) {
            return new SignInUseCaseOutput(false);
        }

        $_SESSION['formInputs']['userId'] = $user['id'];
        $_SESSION['formInputs']['userName'] = $user['user_name'];
        return new SignInUseCaseOutput(true);
    }
}