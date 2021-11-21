<?php

final class SignUpInput
{
  private $name;
  private $email;
  private $password;

  public function __construct(string $name, UserEmail $email, UserPassword $password)
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }

  public function name(): string
  {
    return $this->name;
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