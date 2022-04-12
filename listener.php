<?php

use Core\Infrastructure\Container\DiContainer;
use Modules\Queue\Domain\Contract\QueueServiceInterface;
use Modules\Queue\Domain\ValueObject\RoutingKey;

require __DIR__ . '/config/bootstrap.php';
$definitions = require CONFIG . '/definitions.php';

$container = new DiContainer();
$container->setDefinitions($definitions);
/** @var QueueServiceInterface $queueService */
$queueService = $container->get(QueueServiceInterface::class);
$queueService->getReceiver()->listen(RoutingKey::EMAIL);