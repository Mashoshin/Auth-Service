<?php

namespace src\Modules\User;

use src\Core\Infrastructure\Db\Query;
use src\Modules\User\Domain\Repository\UserRepositoryInterface;
use stdClass;

class UserRepository implements UserRepositoryInterface
{
    public function findUser(string $login, string $password): ?stdClass
    {
        return (new Query())
            ->from($this->getTableName())
            ->where('login', $login)
            ->andWhere('password', $password)
            ->query();
    }

    public function existByLogin(string $login): bool
    {
        $source = (new Query())
            ->from($this->getTableName())
            ->where('login', $login)
            ->query();

        return !!$source;
    }

    public function save(array $params): bool
    {
        return (new Query())->insert($this->getTableName(), $params);
    }

    private function getTableName(): string
    {
        return 'users';
    }
}
