<?php

namespace controllers;

use repositories\PostRepository;

class IndexController extends Controller
{

    public function indexAction()
    {
        var_dump($_GET);
        $postRepo = $this->createPostRepository();
        $data = $postRepo->getPostsForHomePage();

        return $this->getView()->render('index', [
            'first' => $data[0],
            'second' => $data[1],
            'third' => $data[2],
        ]);
    }


    /**
     * @return PostRepository
     */
    protected function createPostRepository(): PostRepository
    {
        return new PostRepository();
    }
}
