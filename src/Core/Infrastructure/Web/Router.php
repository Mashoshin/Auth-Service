<?php

namespace src\Core\Infrastructure\Web;

use Exception;

class Router
{
    private Request $request;
    private array $config = [];
    private string $controller;
    private string $action;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->config = require CONFIG . '/url-rules.php';
        $this->init();
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    private function init(): void
    {
        if (!isset($this->config[$this->request->getUri()])) {
            throw new Exception('Routing error.');
        }

        $path = $this->config[$this->request->getUri()];
        $params = explode('/', $path);
        if (count($params) < 2) {
            throw new Exception('Url config error.');
        }

        $controller = 'src\Modules\\' . ucfirst($params[0]) . '\\' . ucfirst($params[0]) . 'Controller';
        if (!class_exists($controller)) {
            throw new Exception('Controller not found');
        }
        $this->controller = $controller;
        $this->action = $params[1];
    }
}