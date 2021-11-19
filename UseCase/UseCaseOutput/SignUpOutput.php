<?php

final class SignUpOutput
{
    private $isSuccess;

    public function __construct(bool $isSuccess)
    {
      $this->isSuccess = $isSuccess;
    }

    public function isSuccess(): bool
    {
      return $this->isSuccess;
    }

    public function message(): string
    {
      return $this->isSuccess ? "登録が完了しました" : "すでに登録済みのメールアドレスです";
    }
}