<?php
/**
 * Created by PhpStorm.
 * User: AgyKoala
 * Date: 21.01.2018
 * Time: 5:26
 */

namespace core;


use db\DB;

class App
{
    /** @var DB */
    protected static $db;

    /**
     * @return DB
     */
    public static function getDb()
    {
        return static::$db;
    }

    /**
     * @param DB $db
     */
    public static function setDb(DB $db): void
    {
        static::$db;
    }


}
