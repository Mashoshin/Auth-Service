<?php

namespace src\Domain\Web;

class Request
{
    private string $uri;
    private array $queryParams;

    public function __construct()
    {
        $params = parse_url($_SERVER['REQUEST_URI']);
        $this->uri = $params['path'] ?? '';
        parse_str($params['query'] ?? '', $queryParams);
        $this->queryParams = $queryParams;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getQueryParam(string $name)
    {
        return $this->queryParams[$name] ?? null;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getPostParam(string $name)
    {
        return $_POST[$name] ?? null;
    }
}
