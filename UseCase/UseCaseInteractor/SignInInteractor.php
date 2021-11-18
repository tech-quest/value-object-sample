<?php 

final class SignInInteractor
{

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
            return new SignInOutput(false);
        }

        if (!password_verify($this->useCaseInput->password(), $user["password"])) {
            return new SignInOutput(false);
        }

        $_SESSION['formInputs']['userId'] = $user['id'];
        $_SESSION['formInputs']['userName'] = $user['user_name'];
        return new SignInOutput(true);
    }
}