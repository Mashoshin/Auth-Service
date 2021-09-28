<?php

namespace src\Modules\Queue\Domain\Contract;

use src\Modules\Queue\Infrastructure\Receiver;
use src\Modules\Queue\Infrastructure\Sender;

interface QueueServiceInterface
{
    /**
     * @return Sender
     */
    public function getSender(): Sender;

    /**
     * @return Receiver
     */
    public function getReceiver(): Receiver;
}
