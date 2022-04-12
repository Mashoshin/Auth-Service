<?php

namespace Modules\Email;

use Modules\Email\Domain\Contract\EmailServiceInterface;
use Modules\Email\Domain\Mailer;
use Modules\Queue\Domain\ValueObject\RoutingKey;
use Modules\Queue\Infrastructure\Service\QueueService;

class EmailService implements EmailServiceInterface
{
    public function __construct(
        private Mailer $mailer,
        private QueueService $queueService
    ) {}

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
