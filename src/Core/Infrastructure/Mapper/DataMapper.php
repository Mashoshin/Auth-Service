<?php

namespace Core\Infrastructure\Mapper;

use Core\Domain\Mapper\MapperInterface;

class DataMapper implements MapperInterface
{
    public function map(array $source, object|string $target): object
    {
        if (is_string($target) && class_exists($target)) {
            $target = new $target;
        }

        $props = $this->getObjectProps($target);
        foreach ($props as $prop) {
            $target->{$prop} = $source[$prop] ?? null;
        }

        return $target;
    }

    public function toArray(object $source): array
    {
        $props = array_filter($this->getObjectProps($source), fn ($prop) => $prop !== 'id');
        return array_reduce($props, function (array $acc, string $item) use ($source) {
            return [...$acc, ...[$item => $source->$item]];
        }, []);
    }

    private function getObjectProps(object $source): array
    {
        return array_keys(get_object_vars($source));
    }
}
