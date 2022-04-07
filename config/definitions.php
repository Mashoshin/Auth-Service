<?php

use Core\Domain\Mapper\MapperInterface;
use Core\Infrastructure\Mapper\DataMapper;
use Modules\Email\Domain\Contract\EmailServiceInterface;
use Modules\Email\EmailService;
use Modules\Queue\Domain\Contract\QueueServiceInterface;
use Modules\Queue\Infrastructure\Service\QueueService;
use Modules\User\Domain\Repository\UserRepositoryInterface;
use Modules\User\Infrastructure\Repository\UserRepository;

return [
    UserRepositoryInterface::class => UserRepository::class,
    QueueServiceInterface::class => QueueService::class,
    EmailServiceInterface::class => EmailService::class,
    MapperInterface::class => DataMapper::class
];