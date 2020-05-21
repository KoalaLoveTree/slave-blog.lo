<?php

namespace core\helper;

/**
 * Class RequestHelper
 * @package core
 */
class RequestHelper
{
    /**
     * Returns $_POST key value or [$default=null]
     *
     * @param string $key
     * @param mixed $default
     *
     * @return string|null
     */
    public static function getPost(string $key, $default = null): ?string
    {
        return static::getValue($_POST, $key, $default);
    }

    /**
     * Returns $_GET key value or [$default=null]
     * @param string $key
     * @param null $default
     *
     *
     * @return string|null
     */
    public static function getQueryString(string $key, $default = null): ?string
    {
        return static::getValue($_GET, $key, $default);
    }

    /**
     * @param array $data
     * @param string $key
     * @param mixed $default
     *
     * @return string|null
     */
    public static function getValue(array $data, string $key, $default = null): ?string
    {
        return $data[$key] ?? $default;
    }
}
