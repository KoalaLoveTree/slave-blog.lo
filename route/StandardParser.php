<?php

namespace route;


class StandardParser implements RouteParser
{

    public static function parse($original_route)
    {
        $parts = explode('/', $original_route);
        $route = new Route(isset($parts[1]) && $parts[1] ? $parts[1] : 'index', isset($parts[2]) && $parts[2] ? $parts[2] : 'index');
        foreach ($parts as $idx => $part) {
            if ($idx < 2) {
                continue;
            }
            $route->setParams($part);
        }
        return $route;
    }
}
