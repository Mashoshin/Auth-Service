<?php

namespace Modules\Email\Domain\Consumer;

use Modules\Email\Domain\Contract\EmailServiceInterface;
use Modules\Queue\Domain\Contract\ConsumerInterface;

class EmailConsumer implements ConsumerInterface
{
    public function __construct(
        private EmailServiceInterface $emailService
    ) {}

    public function consume($data): void
    {
        $this->emailService->send($data['to'], $data['body']);
    }
}