<?php

namespace src\Modules\Queue\Domain\Contract;

interface ConsumerInterface
{
    /**
     * Receives and handles a message from the queue
     *
     * @param mixed $data
     */
    public function consume($data): void;
}
