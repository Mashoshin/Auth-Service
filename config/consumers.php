<?php

use src\Modules\Email\Domain\Consumer\EmailConsumer;
use src\Modules\Queue\Domain\ValueObject\RoutingKey;

return [
    RoutingKey::EMAIL => EmailConsumer::class
];