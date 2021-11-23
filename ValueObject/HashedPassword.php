<?php

final class HashedPassword
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function verify(InputPassword $inputPassword): bool
    {
        return password_verify($inputPassword->value(), $this->value);
    }
}