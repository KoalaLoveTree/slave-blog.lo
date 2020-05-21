<?php


namespace core\helper;


class ErrorsCheckHelper
{
    const ERRORS = 'errors';

    /**
     * @param string $error
     */
    public static function setError(string $error): void
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
        if (!empty(self::getErrorFromSession())) {
            return true;
        }
        return false;
    }

    /**
     * @param $value
     */
    protected static function writeErrorToSession($value): void
    {
        $_SESSION[self::ERRORS][] = $value;
    }

    protected static function deleteErrors(): void
    {
        if (!empty(self::getErrorFromSession())) {
            unset($_SESSION[self::ERRORS]);
        }
    }

    /**
     * @return string
     */
    protected static function getErrorFromSession(): string
    {
        return $_SESSION[self::ERRORS];
    }
}