<?php

namespace controllers;

use core\helper\AuthSessionHelper;
use repositories\RepositoryStorage;
use response\SuccessResponse;

class WallController extends Controller
{
    public function indexAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();
        return new SuccessResponse($this->getView()->render('wall', [
            'posts' => $postRepository->getPostsByAuthorId(AuthSessionHelper::getId()),
        ]));

    }
}