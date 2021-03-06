<?php

namespace controllers;

use response\RedirectResponse;
use view\View;

class Controller
{
    /** @var View* */
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

    protected function redirect($path)
    {
        $response = new RedirectResponse();
        $response->addHeader('Location: ' . $path);
        return $response;
    }

    /**
     * @return array
     */
    protected function getPost(): array
    {
        return $_POST;
    }
}
