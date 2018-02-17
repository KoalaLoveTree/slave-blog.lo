<?php

namespace models;

use core\helper\ErrorsCheckHelper;
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
        ErrorsCheckHelper::setError($message);
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

    /**
     * @return bool
     */
    abstract protected function validate(): bool;
}
