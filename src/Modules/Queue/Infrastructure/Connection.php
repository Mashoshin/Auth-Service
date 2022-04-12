<?php

namespace Modules\Queue\Infrastructure;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Modules\Queue\Domain\ValueObject\ExchangeName;
use Modules\Queue\Domain\ValueObject\Queue;
use Modules\Queue\Infrastructure\Factory\ConsumerFactory;
use Throwable;

class Connection
{
    public function __construct(
        private AMQPStreamConnection $connection,
        private ConsumerFactory $consumerFactory
    ) {}

    public function publish(string $message, string $routingKey): void
    {
        $message = new AMQPMessage($message);

        $channel = $this->connection->channel();
        $channel->exchange_declare(ExchangeName::ASYNC_JOB, 'direct', false, false, false);
        $channel->basic_publish($message, ExchangeName::ASYNC_JOB, $routingKey);

        $channel->close();
        $this->connection->close();
    }

    public function listen(string $routingKey): void
    {
        $channel = $this->connection->channel();
        $channel->exchange_declare(ExchangeName::ASYNC_JOB, 'direct', false, false, false);
        $queue = (string)(new Queue($routingKey));
        $channel->queue_declare(
            $queue,
            false,
            false,
            false,
            false
        );
        $channel->queue_bind($queue, ExchangeName::ASYNC_JOB, $routingKey);
        $channel->basic_consume(
            $queue,
            '',
            false,
            false,
            false,
            false,
            $this->getCallback($routingKey)
        );

        while ($channel->is_consuming()) {
            $channel->wait();
        }
    }

    private function getCallback($routingKey): callable
    {
        $consumer = $this->consumerFactory->create($routingKey);
        return function (AMQPMessage $msg) use ($consumer) {
            try {
                ob_start();
                $data = json_decode($msg->body, true);
                $consumer->consume($data);
            } catch (Throwable $e) {
                echo $e->getMessage();
            }
        };
    }
}
