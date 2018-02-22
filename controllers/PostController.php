<?php

namespace controllers;

use core\helper\RequestHelper;

use repositories\RepositoryStorage;
use response\SuccessResponse;

class PostController extends Controller
{
    public function showAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('post', [
            'post' => $postRepository->getPostById(RequestHelper::getQueryString('id')),
        ]));
        return $response;
    }
}
