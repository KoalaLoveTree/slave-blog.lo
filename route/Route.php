<?php

namespace route;


class Route
{
    /** @var string * */
    private $controller;

    /** @var string * */
    private $action;

    /** @var string */
    private $path;

    /**
     * Route constructor.
     * @param $path
     * @param $controller
     * @param $action
     */
    public function __construct($path, $controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

}
