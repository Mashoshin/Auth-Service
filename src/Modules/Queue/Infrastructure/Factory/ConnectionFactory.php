<?php

namespace Modules\Queue\Infrastructure\Factory;

use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Modules\Queue\Infrastructure\Connection;
use Throwable;

class ConnectionFactory
{
    public function __construct(
        private ConsumerFactory $consumerFactory
    ) {}

    /**
     * @return Connection
     * @throws Exception
     */
    public function create(): Connection
    {
        while (!$connection = $this->getConnection()) {
            sleep(1);
        }

        if (!$connection->isConnected()) {
            throw new Exception('Queue connection failed.');
        }

        return new Connection($connection, $this->consumerFactory);
    }

    /**
     * @return AMQPStreamConnection|null
     */
    private function getConnection(): ?AMQPStreamConnection
    {
        try {
            return new AMQPStreamConnection(
                getenv('RABBITMQ_HOST'),
                getenv('RABBITMQ_PORT'),
                getenv('RABBITMQ_USER'),
                getenv('RABBITMQ_PASSWORD')
            );
        } catch (Throwable) {
            return null;
        }
    }
}
