<?php

use src\Modules\Email\Domain\Contract\EmailServiceInterface;
use src\Modules\Email\EmailService;
use src\Modules\Queue\Domain\Contract\QueueServiceInterface;
use src\Modules\Queue\Infrastructure\Service\QueueService;
use src\Modules\User\Domain\Repository\UserRepositoryInterface;
use src\Modules\User\UserRepository;

return [
    UserRepositoryInterface::class => UserRepository::class,
    QueueServiceInterface::class => QueueService::class,
    EmailServiceInterface::class => EmailService::class
];