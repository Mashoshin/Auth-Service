<?php

namespace Core\Presentation\Controller;

use Exception;

class BaseController
{
    protected function render(string $view, array $params = []): string
    {
        ob_start();
        ob_implicit_flush(false);

        extract($params);
        $viewFile = $this->getViewFile($view);
        require $viewFile;

        return ob_get_clean();
    }

    protected function redirect(string $url): never
    {
        header("Location: $url");
        exit;
    }

    protected function refresh(string $url): never
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
