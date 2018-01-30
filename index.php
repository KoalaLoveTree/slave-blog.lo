<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
    if (file_exists($file)) {
        include_once $file;
    }
});


use route\Router;
use route\StandardParser;

define('ROOT', dirname(__FILE__) . '/');


$url = $_SERVER['REQUEST_URI'];
$conf = require 'core\config.php';
\core\App::setDbm(new \db\MySQLDBManager($conf['db']));

session_start();

$router = new Router();
echo $router->callAction(StandardParser::parse($url));
