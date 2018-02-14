<?php

namespace models;

use core\helper\RequestHelper;

abstract class BaseModel
{
    /** @var array */
    protected $errors = [];

    /**
     * @return bool
     * @throws \ReflectionException
     */
    public function load(): bool
    {
        $atLeastOneLoaded = false;

        $properties = $this->getPublicProperties();
        foreach ($properties as $property) {
            if ($value = RequestHelper::getPost($property->getName())) {
                $this->{$property->getName()} = $value;
                $atLeastOneLoaded = true;
            }
        }
        return $atLeastOneLoaded;
    }

    /**
     * @param $message
     *
     * @return void
     */
    protected function addError($message)
    {
        $this->errors[] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getErrorString(): string
    {
        $string = '';

        foreach ($this->getErrors() as $error) {
            $string .= $error . PHP_EOL;
        }

        return $string;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->validate();
    }

    /**
     * @return \ReflectionProperty[]
     * @throws \ReflectionException
     */
    protected function getPublicProperties(): array
    {
        return $this->createReflectionClass()->getProperties(\ReflectionProperty::IS_PUBLIC);
    }

    /**
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    protected function createReflectionClass(): \ReflectionClass
    {
        return new \ReflectionClass($this);
    }

    abstract protected function validate(): bool;
}
