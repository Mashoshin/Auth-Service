<?php

namespace Modules\Queue\Domain\ValueObject;

class Queue
{
    private string $routingKey;

    public function __construct(string $routingKey)
    {
        $this->routingKey = $routingKey;
    }

    public function __toString(): string
    {
        return 'auth_' . $this->routingKey . '_q';
    }
}