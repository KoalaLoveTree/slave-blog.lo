<?php

namespace route;

use controllers\Controller;
use core\FileNotFoundException;
use response\NotFoundResponse;
use response\ResponseInterface;
use view\View;

class Router
{

    /**
     * @param Route $route
     * @return ResponseInterface
     */
    public function callAction(Route $route)
    {
        try {
            /** @var string $controllerName */
            $controllerName = $this->getControllerName($route->getPath(), $route->getController());
            if (class_exists($controllerName)) {
                $view = new View();
                $view->setViewPath('view' . DIRECTORY_SEPARATOR . $route->getController());
                /** @var Controller $controller */
                $controller = new $controllerName;
                $controller->setView($view);

                $method = [$controller, $route->getAction() . 'Action'];

                if (!method_exists($method[0], $method[1])) {
                    throw new FileNotFoundException();
                }


                $result = call_user_func_array($method, []);
                if ($result !== false) {
                    return $result;
                }
            }
            throw new FileNotFoundException();
        } catch (FileNotFoundException $e) {
            $response = new NotFoundResponse();
            $response->setContent('Page not found "' . $e->getMessage().'"');
            return $response;
        }
    }

    /**
     * @param $path
     * @param $controller
     * @return string
     */
    protected function getControllerName($path, $controller): string
    {
        if ($this->isControllerHavePath($path)) {
            return $path . DIRECTORY_SEPARATOR .
                ucfirst($controller) . 'Controller';
        } else {
            return ucfirst($controller) . 'Controller';
        }
    }

    /**
     * @param string $controllerPath
     * @return bool
     */
    protected function isControllerHavePath(string $controllerPath): bool
    {
        if (empty($controllerPath)) {
            return false;
        }
        return true;
    }
}
