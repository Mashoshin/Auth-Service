<?php

use Modules\Email\Domain\Consumer\EmailConsumer;
use Modules\Queue\Domain\ValueObject\RoutingKey;

return [
    RoutingKey::EMAIL => EmailConsumer::class
];