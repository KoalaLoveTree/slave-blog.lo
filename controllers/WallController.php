<?php

namespace controllers;

use core\helper\AuthSessionHelper;
use repositories\PostRepository;

class WallController extends Controller
{
    public function indexAction()
    {
        $postRepo = $this->createPostRepository();
        $posts = $postRepo->getPostsByAuthorId(AuthSessionHelper::getId());
        return $this->getView()->render('wall', [
            'posts' => $posts
        ]);

    }

    protected function createPostRepository()
    {
        return new PostRepository();
    }
}