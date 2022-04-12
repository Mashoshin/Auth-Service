<?php

namespace Modules\Queue\Infrastructure;

class Sender
{
    public function __construct(
        private Connection $connection
    ) {}

    /**
     * @param array $data
     * @param string $routingKey
     */
    public function publish(array $data, string $routingKey): void
    {
        $this->connection->publish(json_encode($data), $routingKey);
    }
}