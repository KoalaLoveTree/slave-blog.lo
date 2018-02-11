<?php

namespace route;


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
            if (!self::ifParamsExist($param)){
                return null;
            }
            $tmp = [$param => $param];
        }
        return $tmp;
    }

    /**
     * @param string $name
     * @return bool
     */
    protected static function ifParamsExist(string $name)
    {
        return isset($_GET[$name]);
    }
}