<?php

namespace controllers;

use core\helper\RequestHelper;

use repositories\RepositoryStorage;

class PostController extends Controller
{
    public function showAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();
        return $this->getView()->render('post', [
            'post' => $postRepository->getPostById(RequestHelper::getQueryString('id')),
        ]);
    }
}
