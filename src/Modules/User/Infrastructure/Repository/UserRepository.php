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
            throw new NotFoundException("User with login '$login' does not exist.");
        }

        /** @var User $user */
        $user = $this->mapper->map($source, new User());

        return $user;
    }

    public function existsByLogin(string $login): bool
    {
        $source = (new Query())
            ->from(User::TABLE_NAME)
            ->where(User::FIELD_LOGIN, $login)
            ->query();

        return !!$source;
    }

    public function existsByLoginOrEmail(string $login, string $email): bool
    {
        $source = (new Query())
            ->from(User::TABLE_NAME)
            ->where(User::FIELD_LOGIN, $login)
            ->orWhere(User::FIELD_EMAIL, $email)
            ->query();

        return !!$source;
    }

    public function save(User $user): void
    {
        (new Query())->insert(User::TABLE_NAME, $this->mapper->toArray($user));
    }
}
