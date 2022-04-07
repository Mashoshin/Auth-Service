<?php

namespace Modules\Auth\Infrastructure;

use Core\Domain\Exception\NotFoundException;
use Core\Domain\Exception\ValidationException;
use Core\Infrastructure\Configuration\SecurityConfiguration;
use Modules\Auth\Domain\Exception\WrongPasswordException;
use Modules\Email\Domain\Contract\EmailServiceInterface;
use Modules\User\Domain\Dto\UserDto;
use Modules\User\Infrastructure\Repository\UserRepository;
use Modules\User\Infrastructure\Service\UserService;

class AuthService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserService $userService,
        private EmailServiceInterface $emailService,
        private SecurityConfiguration $securityConfiguration,
    ) {}

    public function isLogin(): bool
    {
        return isset($_SESSION['user_id']) && isset($_SESSION['username']);
    }

    /**
     * @param string $login
     * @param string $password
     * @return void
     * @throws WrongPasswordException
     * @throws NotFoundException
     */
    public function login(string $login, string $password)
    {
        $user = $this->userRepository->getUser($login);
        if (!$this->securityConfiguration->validatePassword($password, $user->password_hash)) {
            throw new WrongPasswordException("User password is incorrect. Please, try another one.");
        }

        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->login;
    }

    public function logout(): void
    {
        $_SESSION = [];
    }

    /**
     * @param UserDto $userDto
     * @return void
     * @throws ValidationException
     */
    public function register(UserDto $userDto): void
    {
        $this->userService->create($userDto);
        $this->emailService->sendQueue($userDto->getEmail(), 'Account was successfully registered!');
    }
}
