<?php

namespace view;

use core\FileNotFoundException;

class View
{
    /** @var string */
    protected $viewPath;
    const LAYOUT = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'layout.php';


    public function render($name, $args): string
    {
        $content = $this->renderView($name, $args);
        return $this->renderLayout($content);
    }


    protected function renderView($name, $args)
    {
        return $this->renderFile($this->getPath($name), $args);
    }

    protected function renderLayout($content)
    {
        return $this->renderFile(static::LAYOUT, ['content' => $content]);
    }

    protected function renderFile(string $path, array $args): string
    {
        extract($args);
        ob_start();
        ob_implicit_flush(false);
        require $path;
        return ob_get_clean();
    }

    /**
     * @return string
     */
    public function getViewPath(): string
    {
        return $this->viewPath;
    }

    /**
     * @param string $viewPath
     */
    public function setViewPath(string $viewPath): void
    {
        $this->viewPath = $viewPath;
    }

    private function getPath(string $name): string
    {
        $real = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $this->viewPath
            . DIRECTORY_SEPARATOR . $name . '.php');
        if (file_exists($real)) {
            return $real;
        } else {
            throw new FileNotFoundException('View ' . $real . ' not found');
        }
    }

}
