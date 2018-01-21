<?php

namespace route;

class Router
{

    public function callAction(Route $route)
    {
        $controllerName = 'controllers\\' . ucfirst($route->getController()).'Controller';
        $controller = new $controllerName;
        call_user_func_array([$controller, $route->getAction().'Action',],($route->getParams()));
    }
}