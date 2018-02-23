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
        if ($original_route == '/') {
            return new Route('controllers', 'index', 'index');
        }
        $newRoute = strstr($original_route, '?', true);
        if (!$newRoute) {
            $parts = self::parse(explode('/', $original_route));
        } else {
            $updateRoute = explode('/', $newRoute);
            array_pop($updateRoute);
            $parts = self::parse($updateRoute);
        }
        return new Route($parts['path'], $parts['controller'], $parts['action']);
    }

    /**
     * @param array $url
     * @return array
     */
    protected static function parse(array $url): array
    {
        array_shift($url);
        $controllerAndPath = self::identifyControllerName($url);
        if ($controllerAndPath['controller']!=='notFound') {
            $action = self::identifyActionName($url, $controllerAndPath);
        }else{
            $action = 'notFound';
        }
        return [
            'path' => $controllerAndPath['path'],
            'controller' => $controllerAndPath['controller'],
            'action' => $action,
        ];
    }

    /**
     * @param array $url
     * @return array
     */
    protected static function identifyControllerName(array $url): array
    {
        $path = array_reverse($url);
        foreach ($path as $piece) {
            array_pop($url);
            $currentPath = self::identifyCurrentPath($url);
            if (self::checkControllerName($piece, $currentPath)) {
                return [
                    'path' => $currentPath,
                    'controller' => $piece,
                ];
            }
        }
        return [
            'path' => 'notFound',
            'controller' => 'notFound',
        ];
    }

    /**
     * @param array $path
     * @return string
     */
    protected static function identifyCurrentPath(array $path): string
    {
        if (empty($path)) {
            return 'controllers';
        }
        return 'controllers' . DIRECTORY_SEPARATOR . implode('\\', $path);
    }

    /**
     * @param string $name
     * @param string $path
     * @return bool
     */
    protected static function checkControllerName(string $name, string $path): bool
    {
        if (!class_exists($path . DIRECTORY_SEPARATOR . ucfirst($name) . 'Controller', true)) {
            return false;
        }
        return true;
    }

    /**
     * @param array $url
     * @param array $controllerAndPath
     * @return string
     */
    protected static function identifyActionName(array $url, array $controllerAndPath): string
    {
        $path = array_reverse($url);
        foreach ($path as $piece) {
            if (self::checkActionName($piece, $controllerAndPath['controller'], $controllerAndPath['path'])) {
                return $piece;
            }
        }
        return 'index';
    }

    /**
     * @param string $name
     * @param string $className
     * @param string $path
     * @return bool
     */
    protected static function checkActionName(string $name, string $className, string $path): bool
    {
        $className = $path . DIRECTORY_SEPARATOR . ucfirst($className) . 'Controller';
        try {
            if (!method_exists(new $className, $name . 'Action')) {
                return false;
            }
        } catch (PermissionDeniedException $e) {
            http_response_code(403);
            die('U\'r not admin');
        }
        return true;
    }
}
