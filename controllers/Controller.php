<?php

namespace controllers;

use view\View;

class Controller
{
    /** @var View**/
    protected $view;

    /**
     * @return View
     */
    public function getView(): View
    {
        return $this->view;
    }

    /**
     * @param View $view
     */
    public function setView(View $view): void
    {
        $this->view = $view;
    }


}