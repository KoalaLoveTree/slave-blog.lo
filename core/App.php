<?php

namespace core;


use db\DB;

class App
{
    /** @var DB */
    protected static $dbm;

    /**
     * @return DB
     */
    public static function getDbm(): DB
    {
        return static::$dbm;
    }

    /**
     * @param DB $db
     */
    public static function setDbm(DB $db): void
    {
        static::$dbm = $db;
    }
}
