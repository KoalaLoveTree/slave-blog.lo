<?php

namespace controllers;

use core\helper\AuthSessionHelper;
use repositories\PostRepository;
use repositories\RepositoryStorage;

class WallController extends Controller
{
    public function indexAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();
        return $this->getView()->render('wall', [
            'posts' => $postRepository->getPostsByAuthorId(AuthSessionHelper::getId()),
        ]);

    }
}