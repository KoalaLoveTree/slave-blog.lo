<?php

namespace controllers;

use view\View;

class Controller
{
    /** @var View**/
    protected $view;

    function __construct()
    {
        $this->view = new View();
    }
}