<?php

namespace Modules\Email\Domain\Contract;

interface EmailServiceInterface
{
    /**
     * @param string $to
     * @param string $body
     */
    public function sendQueue(string $to, string $body): void;

    /**
     * @param string $to
     * @param string $body
     * @return bool
     */
    public function send(string $to, string $body): bool;
}
