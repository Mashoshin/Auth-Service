<?php

namespace Modules\User\Infrastructure\Repository;

use Core\Domain\Exception\NotFoundException;
use Core\Domain\Mapper\MapperInterface;
use Core\Infrastructure\Db\Query;
use Modules\Auth\Domain\Entity\User;
use Modules\User\Domain\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private MapperInterface $mapper
    ) {}

    /**
     * @param string $login
     * @return User
     * @throws NotFoundException
     */
    public function getUser(string $login): User
    {
        $source = (new Query())
            ->from(User::TABLE_NAME)
            ->where('login', $login)
            ->query();

        if (!$source) {
            throw new NotFoundException("User with login '$login' not found.");
        }

        /** @var User $user */
        $user = $this->mapper->map($source, new User());

        return $user;
    }

    public function existByLogin(string $login): bool
    {
        $source = (new Query())
            ->from(User::TABLE_NAME)
            ->where('login', $login)
            ->query();

        return !!$source;
    }

    public function save(User $user): bool
    {
        return (new Query())->insert(User::TABLE_NAME, $this->mapper->toArray($user));
    }
}
