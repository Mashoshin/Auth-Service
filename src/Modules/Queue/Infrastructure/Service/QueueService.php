<?php

namespace Modules\Queue\Infrastructure\Service;

use Modules\Queue\Domain\Contract\QueueServiceInterface;
use Modules\Queue\Infrastructure\Connection;
use Modules\Queue\Infrastructure\Factory\ConnectionFactory;
use Modules\Queue\Infrastructure\Receiver;
use Modules\Queue\Infrastructure\Sender;

class QueueService implements QueueServiceInterface
{
    public function __construct(
        private ConnectionFactory $connectionFactory
    ) {}

    /**
     * @inheritDoc
     */
    public function getSender(): Sender
    {
        $connection = $this->getConnection();
        return new Sender($connection);
    }

    /**
     * @inheritDoc
     */
    public function getReceiver(): Receiver
    {
        $connection = $this->getConnection();
        return new Receiver($connection);
    }

    private function getConnection(): Connection
    {
        return $this->connectionFactory->create();
    }
}