<?php

namespace src\Core\Infrastructure\Db;

use PDO;

class Db
{
    private static ?PDO $connection = null;

    public static function getConnection()
    {
        if (!static::$connection) {
            static::setConnection();
        }

        return static::$connection;
    }

    private static function setConnection()
    {
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $dsn = 'pgsql:host='.getenv('DB_HOST').';dbname='.getenv('DB_NAME');
        static::$connection = new PDO($dsn, $user, $password);
    }
}
