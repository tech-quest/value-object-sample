<?php

final class SignUpOutput
{
    private $isSuccess;

    public function __construct(bool $isSuccess)
    {
      $this->isSuccess = $isSuccess;
      if (!$isSuccess) {
        $_SESSION['errors'][] = "すでに登録済みのメールアドレスです";
      }
    }

    public function redirectUrl(): string
    {
      if ($this->isSuccess) return './signin.php';

      return './signup.php';      
    }
}