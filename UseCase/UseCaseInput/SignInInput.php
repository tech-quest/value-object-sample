<?php

final class SignInInput
{
    private $email;
    private $password;

    public function __construct(UserEmail $email, UserPassword $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }
}