<?php

namespace Core\Infrastructure\Db;

use Exception;
use PDOStatement;

class Query
{
    private string $from = '';
    private string $where = '';

    public function from(string $tableName)
    {
        $this->from = $tableName;
        return $this;
    }

    public function where(string $property, $value): self
    {
        $this->where .= " $property='$value'";
        return $this;
    }

    public function orWhere(string $property, $value): self
    {
        $this->where .= " OR $property='$value'";
        return $this;
    }

    public function query(): ?array
    {
        if (!$this->from) {
            throw new Exception('Missing FROM param.');
        }

        $where = $this->where ? " WHERE $this->where" : '';
        $sql = 'SELECT * FROM public.' . $this->from . $where;

        $statement = Db::getConnection()->query($sql . ';');
        if ($statement instanceof PDOStatement) {
            $object = $statement->fetchObject();
            if ($object) {
                return (array) $object;
            }
        }

        return null;
    }

    public function insert(string $tableName, array $params): bool
    {
        $columns = implode(',', array_keys($params));
        $values = implode("','", array_values($params));
        $sql = "INSERT INTO \"$tableName\" ($columns) VALUES('$values')";
        return !!(Db::getConnection()->exec($sql));
    }
}
