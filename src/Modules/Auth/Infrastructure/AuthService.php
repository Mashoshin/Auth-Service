<?php

namespace src\Modules\Auth\Infrastructure;

use src\Modules\Email\Domain\Contract\EmailServiceInterface;
use src\Modules\User\Domain\Dto\UserDto;
use src\Modules\User\Infrastructure\UserService;

class AuthService
{
    private UserService $userService;
    private EmailServiceInterface $emailService;

    public function __construct(UserService $userService, EmailServiceInterface $emailService)
    {
        $this->userService = $userService;
        $this->emailService = $emailService;
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

    public function register(UserDto $userDto): bool
    {
        if ($this->userService->create($userDto)) {
            $this->emailService->sendQueue($userDto->getEmail(), 'Account was successfully registered!!!');
            return true;
        }

        return false;
    }
}
