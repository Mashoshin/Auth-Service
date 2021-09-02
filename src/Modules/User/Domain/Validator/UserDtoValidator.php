<?php

namespace src\Modules\User\Domain\Validator;

use Exception;
use src\Modules\User\Domain\Dto\UserDto;
use src\Modules\User\Domain\Repository\UserRepositoryInterface;

class UserDtoValidator
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserDto $userDto
     * @throws Exception
     */
    public function validate(UserDto $userDto): void
    {
        if (empty($userDto->getEmail())) {
            throw new Exception('Wrong email. Try again.');
        }

        if (strlen($userDto->getPassword()) < 5) {
            throw new Exception('Password must be more than 5 characters long.');
        }

        if ($this->userRepository->existByLogin($userDto->getLogin())) {
            throw new Exception('User with this login already exist.');
        }
    }
}