<?php

namespace src\Modules\User\Domain\Repository;

interface UserRepositoryInterface
{
    /**
     * @param string $login
     * @return bool
     */
    public function existByLogin(string $login): bool;

    /**
     * @param string $login
     * @param string $password
     * @return object|null
     */
    public function findUser(string $login, string $password): ?object;
}