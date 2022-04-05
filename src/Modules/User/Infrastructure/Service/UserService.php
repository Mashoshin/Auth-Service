<?php

namespace Modules\User\Infrastructure\Service;

use Core\Infrastructure\Configuration\SecurityConfiguration;
use Modules\Auth\Domain\Entity\User;
use Modules\User\Domain\Dto\UserDto;
use Modules\User\Domain\Validator\UserDtoValidator;
use Modules\User\Infrastructure\Repository\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserDtoValidator $userDtoValidator,
        private SecurityConfiguration $securityConfiguration,
    ) {}

    public function create(UserDto $userDto): bool
    {
        $this->userDtoValidator->validate($userDto);

        $user = new User();
        $user->email = $userDto->getEmail();
        $user->login = $userDto->getLogin();
        $user->password_hash = $this->securityConfiguration->generatePasswordHash($userDto->getPassword());

        return $this->userRepository->save($user);
    }
}
