<?php

namespace src\Modules\User\Domain\Dto;

class UserDto
{
    private string $email;
    private string $login;
    private string $password;

    public function __construct(
        string $email,
        string $login,
        string $password
    )
    {
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function __invoke(): array
    {
        return [
            'email' => $this->email,
            'login' => $this->login,
            'password' => $this->password,
        ];
    }
}