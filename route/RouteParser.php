<?php

namespace route;


interface RouteParser
{
    /**
     * @param $original_route
     * @return Route
     */
    public static function parseUrl($original_route):Route;
}
