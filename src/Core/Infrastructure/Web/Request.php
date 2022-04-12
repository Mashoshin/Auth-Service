<?php

namespace Core\Infrastructure\Web;

class Request
{
    private string $uri;
    private array $queryParams;

    public function __construct()
    {
        $this->init();
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getQueryParam(string $name): mixed
    {
        return $this->queryParams[$name] ?? null;
    }

    public function getPostParam(string $name): mixed
    {
        return $_POST[$name] ?? null;
    }

    private function init(): void
    {
        $params = parse_url($_SERVER['REQUEST_URI']);
        $this->uri = $params['path'] ?? '';
        parse_str($params['query'] ?? '', $queryParams);
        $this->queryParams = $queryParams;
    }
}
