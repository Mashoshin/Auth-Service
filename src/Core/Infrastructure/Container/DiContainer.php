<?php

namespace Core\Infrastructure\Container;

use Exception;
use Psr\Container\ContainerInterface;
use ReflectionClass;

class DiContainer implements ContainerInterface
{
    private array $definitions = [];
    private array $dependencyList = [];

    public function setDefinitions(array $definitions): void
    {
        $this->definitions = $definitions;
    }

    public function set(string $abstract, string $concrete = null): void
    {
        $this->definitions[$abstract] = $concrete ?? $abstract;
    }

    public function get(string $id)
    {
        if ($id === ContainerInterface::class) {
            return $this;
        }

        $realization = $id;
        if (isset($this->definitions[$id])) {
            $realization = $this->definitions[$id];
        }

        if (is_string($realization)) {
            $className = $realization;
        } else {
            throw new Exception('Unsupported format of DI realization. Expected string.');
        }

        if (!isset($this->dependencyList[$className])) {
            $reflectionClass = new ReflectionClass($className);
            $constructor = $reflectionClass->getConstructor();
            $this->dependencyList[$className] = [];

            if ($constructor) {
                foreach ($constructor->getParameters() as $param) {
                    $this->dependencyList[$className][] = $param->getType()->getName();
                }
            }
        }

        $dependencies = [];
        foreach ($this->dependencyList[$className] as $dependencyItem) {
            $dependencies[] = $this->get($dependencyItem);
        }

        return new $className(...$dependencies);
    }

    public function has(string $id): bool
    {
        return isset($this->definitions[$id]);
    }
}
