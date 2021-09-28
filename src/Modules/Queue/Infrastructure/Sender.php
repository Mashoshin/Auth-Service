<?php

namespace src\Modules\Queue\Infrastructure;

class Sender
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param array $data
     * @param string $routingKey
     */
    public function publish(array $data, string $routingKey): void
    {
        $this->connection->publish(json_encode($data), $routingKey);
    }
}