<?php

use src\Modules\User\Domain\Repository\UserRepositoryInterface;
use src\Modules\User\UserRepository;

return [
    UserRepositoryInterface::class => UserRepository::class,
];