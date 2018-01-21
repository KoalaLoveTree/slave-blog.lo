<?php

namespace route;

use controllers\Controller;
use core\FileNotFoundException;
use view\View;

class Router
{

    public function callAction(Route $route)
    {
        $controllerName = 'controllers\\' . ucfirst($route->getController()) . 'Controller';
        try {
            if (class_exists($controllerName)) {
                $view = new View();
                $view->setViewPath('view' . DIRECTORY_SEPARATOR . $route->getController());
                /** @var Controller $controller */
                $controller = new $controllerName;
                $controller->setView($view);
                $result = call_user_func_array([$controller, $route->getAction() . 'Action',], ($route->getParams()));
                if ($result !== false) {
                    return $result;
                }
            }

            throw new FileNotFoundException();
        } catch (FileNotFoundException $e) {
            http_response_code(404);
            die('Page not found');
        }
    }
}
