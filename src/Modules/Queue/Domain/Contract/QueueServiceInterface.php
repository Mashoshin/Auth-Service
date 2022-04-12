<?php

namespace Modules\Queue\Domain\Contract;

use Modules\Queue\Infrastructure\Receiver;
use Modules\Queue\Infrastructure\Sender;

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
