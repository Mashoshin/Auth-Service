<?php

namespace Modules\Auth\Domain\Entity;

use Core\Domain\Entity\EntityInterface;

class User implements EntityInterface
{
    public const TABLE_NAME = 'users';

    /** @var int */
    public $id;

    /** @var string */
    public $email;

    /** @var string */
    public $login;

    /** @var string */
    public $password_hash;

    public function getTableName(): string
    {
        return self::TABLE_NAME;
    }
}
