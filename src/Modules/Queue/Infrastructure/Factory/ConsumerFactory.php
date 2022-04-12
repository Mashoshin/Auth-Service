<?php

namespace Modules\Queue\Infrastructure\Factory;

use Exception;
use Psr\Container\ContainerInterface;
use Modules\Queue\Domain\Contract\ConsumerInterface;

class ConsumerFactory
{
    private array $consumers;

    public function __construct(
        private ContainerInterface $container
    ) {
        $this->consumers = require CONFIG . '/consumers.php';
    }

    public function create(string $routingKey): ConsumerInterface
    {
        if (!isset($this->consumers[$routingKey])) {
            throw new Exception("Consumer not found for routing key '$routingKey'");
        }

        return $this->container->get($this->consumers[$routingKey]);
    }
}
