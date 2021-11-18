<?php

final class SignInOutput
{
    private $isSuccess;

    public function __construct(bool $isSuccess)
    {
      $this->isSuccess = $isSuccess;
      if (!$isSuccess) {
        $_SESSION['errors'][] = "メールアドレスまたは<br />パスワードが違います";
      }
    }

    public function redirectUrl(): string
    {
      if ($this->isSuccess) return "../index.php";
      
      return "./signin.php";
    }
}