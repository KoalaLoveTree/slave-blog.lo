<?php

namespace core;

use route\Router;
use route\StandardParser;

require_once 'config.php';

$url = $_SERVER['REQUEST_URI'];


spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    include dirname(__DIR__) .DIRECTORY_SEPARATOR. $class . '.php';
});

    $router = new Router();
    $router->callAction(StandardParser::parse('test/test/sayhello'));