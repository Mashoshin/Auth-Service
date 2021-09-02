<?php

namespace src\Modules\Auth\Infrastructure;

use src\Modules\User\Domain\Dto\UserDto;
use src\Modules\User\Infrastructure\UserService;

class AuthService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function isLogin(): bool
    {
        return isset($_SESSION['user_id']) && isset($_SESSION['username']);
    }

    public function login(string $login, string $password)
    {
        $user = $this->userService->getUser($login, $password);
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->login;
    }

    public function logout(): void
    {
        $_SESSION = [];
    }

    public function register(UserDto $userDto)
    {
        if ($this->userService->create($userDto)) {
            return true;
        }

        return false;
    }
}
