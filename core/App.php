<?php

namespace core;


use db\DB;
use db\MySQLDBManager;

class App
{
    /** @var DB */
    protected static $dbm;

    /**
     * @return DB
     */
    public static function getDbm()
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
