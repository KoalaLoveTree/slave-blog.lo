<?php

namespace controllers\admin;


class AdminPanelController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        echo 'index';
    }

    public function showAction()
    {
        echo 'show';
    }
}