<?php

namespace src\Modules\Email;

use src\Modules\Email\Domain\Contract\EmailServiceInterface;
use src\Modules\Email\Domain\Mailer;
use src\Modules\Queue\Domain\ValueObject\RoutingKey;
use src\Modules\Queue\Infrastructure\Service\QueueService;

class EmailService implements EmailServiceInterface
{
    private Mailer $mailer;
    private QueueService $queueService;

    public function __construct(Mailer $mailer, QueueService $queueService)
    {
        $this->mailer = $mailer;
        $this->queueService = $queueService;
    }

    /**
     * @param string $to
     * @param string $body
     */
    public function sendQueue(string $to, string $body): void
    {
        $this->queueService->getSender()->publish(['to' => $to, 'body' => $body], RoutingKey::EMAIL);
    }

    /**
     * @param string $to
     * @param string $body
     * @return bool
     */
    public function send(string $to, string $body): bool
    {
        $message = $this->mailer->getMessage();
        $message->setTo($to);
        $message->setBody($body);
        $message->setFrom(['system@test.test' => 'System']);
        if (!!$this->mailer->getMailer()->send($message)) {
            return true;
        }

        return false;
    }
}
