<?php

namespace controllers;

use repositories\RepositoryStorage;
use response\SuccessResponse;

class IndexController extends Controller
{

    public function indexAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();

        return new SuccessResponse($this->getView()->render('index', [
            'posts' => $postRepository->getPostsForHomePage(),
        ]));
    }

}
