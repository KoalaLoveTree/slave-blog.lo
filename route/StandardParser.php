<?php

namespace route;


use core\PermissionDeniedException;

class StandardParser implements RouteParser
{
    /**
     * @param $original_route
     * @return Route
     */
    public static function parseUrl($original_route): Route
    {
        $newRoute = strstr($original_route,'?',true);
        if (!$newRoute){
            $parts = self::parse(explode('/', $original_route));
        }else{
            $updateRoute = explode('/', $newRoute);
            array_pop($updateRoute);
            $parts = self::parse($updateRoute);
        }
        $route = new Route($parts[0], $parts[1], $parts[2]);
        var_dump($route);
        return $route;
    }

    /**
     * @param array $url
     * @return array
     */
    protected static function parse(array $url): array
    {
        var_dump($url);
        $newUrl = self::checkUrlType($url);
        if ($newUrl != null) {
            return $newUrl;
        }
        array_shift($url);
        $count = count($url);
        $path = 'controllers';
        for ($i = $count - 3; $i >= 0; $i--) {
            $path .= DIRECTORY_SEPARATOR . $url[$i];
        }
        $controller = self::checkControllerName($url[$count - 2], $path);
        $action = self::checkActionName($url[$count - 1], $controller, $path);
        return [
            '0' => $path,
            '1' => $controller,
            '2' => $action,
        ];
    }

    /**
     * @param array $url
     * @return array
     */
    protected static function checkUrlType(array $url): ?array
    {


        /*just help pls*/
        if (count($url)>=4){
            return null;
        }
        if (empty($url[0]) && empty($url[1])) {
            return [
                '0' => 'controllers',
                '1' => 'index',
                '2' => 'index',
            ];
        }
        if (empty($url[2]) && !empty($url[1])) {
            return [
                '0' => 'controllers',
                '1' => $url[1],
                '2' => 'index',
            ];
        }
        return [
            '0' => 'controllers',
            '1' => $url[1],
            '2' => $url[2],
        ];
    }

    /**
     * @param string $name
     * @param string $path
     * @return string
     */
    protected
    static function checkControllerName(string $name, string $path): string
    {
        if (!class_exists($path . DIRECTORY_SEPARATOR . ucfirst($name) . 'Controller', true)) {
            return 'index';
        }
        return $name;
    }

    /**
     * @param string $name
     * @param string $className
     * @param string $path
     * @return string
     */
    protected static function checkActionName(string $name, string $className, string $path): string
    {
        $className = $path .DIRECTORY_SEPARATOR .ucfirst($className) . 'Controller';
        try {
            if (!method_exists(new $className, $name . 'Action')) {
                return 'index';
            }
        }catch (PermissionDeniedException $e){
            http_response_code(403);
            die('U\'r not admin');
        }
        return $name;
    }
}
