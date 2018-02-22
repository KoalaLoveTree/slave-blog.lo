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
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('wall', [
            'posts' => $postRepository->getPostsByAuthorId(AuthSessionHelper::getId()),
        ]));
        return $response;

    }
}