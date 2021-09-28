<?php

namespace src\Modules\Email\Domain\Consumer;

use src\Modules\Email\Domain\Contract\EmailServiceInterface;

use src\Modules\Queue\Domain\Contract\ConsumerInterface;

class EmailConsumer implements ConsumerInterface
{
    private EmailServiceInterface $emailService;

    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function consume($data): void
    {
        $this->emailService->send($data['to'], $data['body']);
    }
}