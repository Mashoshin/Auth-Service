<?php

namespace src\Modules\User\Infrastructure;

use Exception;
use src\Modules\User\Domain\Dto\UserDto;
use src\Modules\User\Domain\Validator\UserDtoValidator;
use src\Modules\User\UserRepository;
use stdClass;

class UserService
{
    private UserRepository $userRepository;
    private UserDtoValidator $userDtoValidator;

    public function __construct(UserRepository $userRepository, UserDtoValidator $userDtoValidator)
    {
        $this->userRepository = $userRepository;
        $this->userDtoValidator = $userDtoValidator;
    }

    public function getUser($login, $password): ?stdClass
    {
        $user = $this->userRepository->findUser($login, $password);
        if (!$user) {
            throw new Exception('User not found.');
        }

        return $user;
    }

    public function create(UserDto $userDto): bool
    {
        $this->userDtoValidator->validate($userDto);
        return $this->userRepository->save($userDto());
    }
}
