<?php

namespace src\Core\Presentation\Controller;

use Exception;
use Psr\Container\ContainerInterface;
use src\Core\Infrastructure\Web\Request;

class BaseController
{
    protected ContainerInterface $container;
    protected Request $request;

    public function __construct(
        ContainerInterface $container,
        Request $request
    ) {
        $this->container = $container;
        $this->request = $request;
    }

    protected function render(string $view, array $params = []): string
    {
        ob_start();
        ob_implicit_flush(false);

        extract($params);
        $viewFile = $this->getViewFile($view);
        require $viewFile;

        return ob_get_clean();
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    protected function refresh(string $url)
    {
        header("Refresh:1;url=$url");
        exit;
    }

    private function getViewFile(string $view): string
    {
        $file = VIEW . '/' . "$view.php";
        if (!is_file($file)) {
            throw new Exception('View file does not exist.');
        }

        return $file;
    }
}
