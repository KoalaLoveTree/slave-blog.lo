<?php

namespace controllers;

use repositories\PostRepository;

class WallController extends Controller
{
    public function indexAction()
    {
        $postRepo = $this->createPostRepository();
        $posts = $postRepo->getPostsByAuthorId($_SESSION['userId']);
        return $this->getView()->render('wall',[
            'posts' => $posts
        ]);

    }

    protected function createPostRepository()
    {
        return new PostRepository();
    }
}