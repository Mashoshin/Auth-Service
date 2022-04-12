<?php

namespace Modules\Queue\Infrastructure;

class Receiver
{
    public function __construct(
        private Connection $connection
    ) {}

    /**
     * @param string $routingKey
     */
    public function listen(string $routingKey): void
    {
        $this->connection->listen($routingKey);
    }
}
