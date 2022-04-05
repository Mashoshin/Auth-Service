<?php

namespace Core\Domain\Entity;

interface EntityInterface
{
    public function getTableName(): string;
}
