<?php

namespace Modules\User\Domain\Repository;

interface UserRepositoryInterface
{
    public function existsByLogin(string $login): bool;
    public function existsByLoginOrEmail(string $login, string $email): bool;
    public function getUser(string $login): object|null;
}
