<?php

namespace route;


use core\helper\RequestHelper;

class ParseParams
{
    /**
     * @param array $paramsName
     * @return array|null
     */
    public static function getParams(array $paramsName): ?array
    {
        $tmp = [];
        foreach ($paramsName as $param) {
            if (!self::ifParamsExist($param)) {
                return null;
            }
            $tmp = [$param => self::getParam($param)];
        }
        return $tmp;
    }

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
     * @return mixed|null
     */
    protected static function getParam(string $name): ?mixed
    {
        return RequestHelper::getQueryString($name);
    }
}