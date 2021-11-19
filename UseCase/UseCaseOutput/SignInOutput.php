<?php

final class SignInOutput
{
    private $isSuccess;
    
    public function __construct(bool $isSuccess, string | array $signInResult)
    {
        $this->isSuccess = $isSuccess;
        $this->signInResult = $signInResult;
    }
    
    public function isSuccess(): bool
    {
      return $this->isSuccess;
    }

    public function signInResult(): string | array
    {
      return $this->signInResult;
    }
}