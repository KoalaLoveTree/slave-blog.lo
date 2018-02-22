<?php


namespace core\helper;


class ErrorsCheckHelper
{
    const ERRORS = 'errors';

    public static function setError(string $error)
    {
        self::writeErrorToSession($error);
    }

    /**
     * @return array|null
     */
    public static function getErrors(): ?array
    {
        $errors = self::getErrorFromSession();
        self::deleteErrors();
        return $errors;
    }

    /**
     * @return bool
     */
    public static function isErrorsExist(): bool
    {
        if (!empty(self::getErrorFromSession())){
            return true;
        }
        return false;
    }

    /**
     * @param $value
     */
    protected static function writeErrorToSession($value)
    {
        $_SESSION[self::ERRORS][] = $value;
    }

    protected static function deleteErrors()
    {
        if (!empty(self::getErrorFromSession())){
            unset($_SESSION[self::ERRORS]);
        }
    }

    /**
     * @return mixed
     */
    protected static function getErrorFromSession()
    {
        return $_SESSION[self::ERRORS];
    }
}