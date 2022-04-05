<?php

namespace Core\Infrastructure\Configuration;

class SecurityConfiguration
{
    public function generatePasswordHash(string $password): string
    {
        return password_hash($password, null);
    }

    public function validatePassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}