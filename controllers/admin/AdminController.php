<?php

namespace controllers\admin;

use controllers\Controller;
use core\helper\AuthSessionHelper;
use core\PermissionDeniedException;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     * @throws PermissionDeniedException
     */
    public function __construct()
    {
        if (!AuthSessionHelper::isAdmin()) {
            throw new PermissionDeniedException();
        }
    }
}
