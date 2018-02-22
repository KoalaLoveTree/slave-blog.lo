<?php

namespace controllers;

use repositories\RepositoryStorage;
use response\SuccessResponse;

class IndexController extends Controller
{

    public function indexAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('index', [
            'posts' => $postRepository->getPostsForHomePage(),
        ]));
        return $response;
    }

}
