<?php

namespace src\Modules\Queue\Infrastructure\Factory;

use Exception;
use Psr\Container\ContainerInterface;
use src\Modules\Queue\Domain\Contract\ConsumerInterface;

class ConsumerFactory
{
    private ContainerInterface $container;
    private array $consumers;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
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
