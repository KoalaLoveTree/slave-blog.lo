<?php

namespace controllers;

use repositories\RepositoryStorage;

class IndexController extends Controller
{

    public function indexAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();

        return $this->getView()->render('index', [
            'posts' => $postRepository->getPostsForHomePage(),
        ]);
    }

}
