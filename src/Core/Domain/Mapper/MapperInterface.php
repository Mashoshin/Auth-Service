<?php

namespace Core\Domain\Mapper;

interface MapperInterface
{
    public function map(array $source, object|string $target): object;
    public function toArray(object $source): array;
}
