<?php

namespace route;


class StandardParser implements RouteParser
{
    /**
     * @param $original_route
     * @return Route
     */
    public static function parseUrl($original_route): Route
    {
        $parts = self::parse(explode('/', $original_route));
        $route = new Route(isset($parts[0]) && $parts[0] ? $parts[0] : '',
            isset($parts[1]) && $parts[1] ? $parts[1] : 'index',
            isset($parts[2]) && $parts[2] ? $parts[2] : 'index');
        return $route;
    }

    protected static function parse(array $url): array
    {
        $count = count($url);
        if ($count <= 2) {
            return $url;
        }
        $path = '';
        $controller = self::checkControllerName($url[$count - 2]);
        var_dump($controller);
        $action = self::checkActionName($url[$count - 1], $controller);
        for ($i = $count - 3; $i > 0; $i--) {
            $path .= $url[$i];
        }
        return [
            '0' => $path,
            '1' => $controller,
            '2' => $action,
        ];
    }

    protected static function checkControllerName(string $name): string
    {
        if (!class_exists(ucfirst($name).'Controller')) {
            return 'index';
        }
        return $name;
    }

    protected static function checkActionName(string $name, string $className): string
    {
        $className = ucfirst($className).'Controller';
        if (!method_exists(new $className, $name)) {
            return 'index';
        }
        return $name;
    }
}
