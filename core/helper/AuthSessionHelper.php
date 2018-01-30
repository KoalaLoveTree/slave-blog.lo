<?php
/**
 * Created by PhpStorm.
 * User: andreyons
 * Date: 1/30/18
 * Time: 10:59 PM
 */

namespace core\helper;

use db\entity\User;

class AuthSessionHelper
{
    const KEY_AUTH = 'AUTH';

    /**
     * @param User $user
     */
    public static function login(User $user)
    {
        self::writeToSession(self::KEY_AUTH, $user->getId());
    }

    /**
     * @param $key
     * @param $value
     */
    protected static function writeToSession($key, $value)
    {
        $_SERVER[$key] = $value;
    }
}
