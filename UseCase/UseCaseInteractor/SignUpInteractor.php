<?php

final class SignUpInteractor
{

  private $useCaseInput;

  public function __construct(SignUpInput $useCaseInput)
  {
    $this->useCaseInput = $useCaseInput;
  }

  public function handler(): SignUpOutput
  {
    $userDao = new UserDao();
    $user = $userDao->findByMail($this->useCaseInput->email());

    if (!is_null($user)) {
      return new SignUpOutput(false);
    }

    $userDao->create($this->useCaseInput->name(), $this->useCaseInput->email(), $this->useCaseInput->password());
    $_SESSION['message'] = "登録できました。";
    return new SignUpOutput(true);
  }
}