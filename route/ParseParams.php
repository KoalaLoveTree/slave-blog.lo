<?php

namespace route;


use core\helper\RequestHelper;

class ParseParams
{
    /**
     * @param string $name
     * @return bool
     */
    protected static function ifParamsExist(string $name): bool
    {
        return isset($_GET[$name]);
    }

    /**
     * @param string $name
     * @return string|null
     */
    protected static function getParam(string $name): ?string
    {
        return RequestHelper::getQueryString($name);
    }
}