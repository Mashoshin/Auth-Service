<?php

namespace Modules\User\Domain\Validator;

use Core\Domain\Exception\ValidationException;
use Exception;
use Modules\User\Domain\Dto\UserDto;
use Modules\User\Domain\Repository\UserRepositoryInterface;

class UserDtoValidator
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserDto $userDto
     * @return void
     * @throws ValidationException
     */
    public function validate(UserDto $userDto): void
    {
        if (empty($userDto->getEmail()) || !filter_var($userDto->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('Email is incorrect.');
        }

        if (strlen($userDto->getPassword()) <= 5) {
            throw new ValidationException('Password must be more than 5 characters long.');
        }

        if ($this->userRepository->existsByLoginOrEmail($userDto->getLogin(), $userDto->getEmail())) {
            throw new ValidationException('User with same email or login already exists.');
        }
    }
}