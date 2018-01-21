<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file =  __DIR__ .DIRECTORY_SEPARATOR. $class . '.php';
    if (file_exists($file)) {
        include_once $file;
    }
});

use route\Router;
use route\StandardParser;

$url = $_SERVER['REQUEST_URI'];
//App::setDb(new DBManager($conf['db']));



$router = new Router();
echo $router->callAction(StandardParser::parse($url));