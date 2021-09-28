<?php

namespace src\Modules\Queue\Infrastructure;

class Receiver
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $routingKey
     */
    public function listen(string $routingKey): void
    {
        $this->connection->listen($routingKey);
    }
}
