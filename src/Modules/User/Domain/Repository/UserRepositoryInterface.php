<?php

namespace Modules\User\Domain\Repository;

interface UserRepositoryInterface
{
    public function existByLogin(string $login): bool;
    public function getUser(string $login): object|null;
}
