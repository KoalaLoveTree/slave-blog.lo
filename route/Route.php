<?php

namespace route;


class Route
{
    /** @var array * */
    private $params;

    /** @var string * */
    private $controller;

    /** @var string * */
    private $action;

    public function __construct($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }

    public function setParams($params)
    {
        $this->params[] = $params;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }



}