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
    const KEY_STATUS = 'STATUS';
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'admin';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_GUEST = 'guest';

    /**
     * @return bool
     */
    public static function isLoggedIn(): bool
    {
        return isset($_SESSION[static::KEY_AUTH]);
    }

    public static function getId(): ?string
    {
        if (self::isLoggedIn()){
            return $_SESSION[self::KEY_AUTH];
        }
        return null;
    }

    /**
     * @return null|string
     */
    protected static function getRole(): string
    {
        return $_SESSION[static::KEY_STATUS] ?? static::ROLE_GUEST;
    }

    /**
     * @param string $role
     * @return bool
     */
    protected static function isRole(string $role): bool
    {
        return $role === self::getRole();
    }

    /**
     * @return bool
     */
    public static function isUser(): bool
    {
        return self::isRole(self::ROLE_USER);
    }

    /**
     * @return bool
     */
    public static function isAdmin(): bool
    {
        return self::isRole(self::ROLE_ADMIN);
    }

    /**
     * @return bool
     */
    public static function isModer(): bool
    {
        return self::isRole(self::ROLE_MODERATOR);
    }

    /**
     * @param User $user
     */
    public static function login(User $user)
    {
        self::writeToSession(self::KEY_AUTH, $user->getId());
        self::writeToSession(self::KEY_STATUS, $user->getRole());
    }

    /**
     * @param $key
     * @param $value
     */
    protected static function writeToSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function logOut(): void
    {
        session_destroy();
    }
}
