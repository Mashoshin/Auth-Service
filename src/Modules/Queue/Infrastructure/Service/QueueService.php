<?php

namespace src\Modules\Queue\Infrastructure\Service;

use src\Modules\Queue\Domain\Contract\QueueServiceInterface;
use src\Modules\Queue\Infrastructure\Connection;
use src\Modules\Queue\Infrastructure\Factory\ConnectionFactory;
use src\Modules\Queue\Infrastructure\Receiver;
use src\Modules\Queue\Infrastructure\Sender;

class QueueService implements QueueServiceInterface
{
    private ConnectionFactory $connectionFactory;

    public function __construct(ConnectionFactory $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
    }

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