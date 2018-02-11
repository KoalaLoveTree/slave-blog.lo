<?php

namespace controllers\admin;

use controllers\Controller;
use core\helper\AuthSessionHelper;
use core\PermissionDeniedException;

class AdminController extends Controller
{
    public function __construct()
    {
        if (!AuthSessionHelper::isAdmin()) {
            throw new PermissionDeniedException();
        }
    }
}
