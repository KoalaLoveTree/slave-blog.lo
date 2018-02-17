<?php


namespace core\helper;


class ErrorsCheckHelper
{
    const ERROR = 'error';

    public static function setError(string $error)
    {
        self::writeErrorToSession($error);
    }

    /**
     * @return null|string
     */
    public static function getError(): ?string
    {
        return self::getErrorFromSession();
    }

    /**
     * @return bool
     */
    public static function checkForErrors(): bool
    {
        if (!empty(self::getErrorFromSession())){
            return false;
        }
        return true;
    }

    /**
     * @param $value
     */
    protected static function writeErrorToSession($value)
    {
        $_SESSION[self::ERROR] = $value;
    }

    public static function deleteError()
    {
        if (!empty(self::getErrorFromSession())){
            unset($_SESSION[self::ERROR]);
        }
    }

    /**
     * @return mixed
     */
    protected static function getErrorFromSession()
    {
        return $_SESSION[self::ERROR];
    }
}