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
      return new SignUpOutput(false, "すでに登録済みのメールアドレスです");
    }

    $userDao->create($this->useCaseInput->name(), $this->useCaseInput->email(), $this->useCaseInput->password());
    return new SignUpOutput(true, "登録が完了しました");
  }
}