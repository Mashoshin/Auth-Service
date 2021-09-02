<?php

namespace src;

use Psr\Container\ContainerInterface;
use src\Core\Infrastructure\Container\DiContainer;
use src\Core\Infrastructure\Web\Router;

class App
{
    private ContainerInterface $container;
    private Router $router;

    public function __construct(array $config = [])
    {
        $this->container = new DiContainer();
        $this->container->setDefinitions($config['definitions']);
        $this->router = $this->container->get(Router::class);
    }

    public function run()
    {
        $controller = $this->router->getController();
        $action = $this->router->getAction();
        return ($this->container->get($controller))->$action();
    }
}
