<?php

namespace controllers;

use core\FileNotFoundException;
use repositories\RepositoryStorage;
use response\ResponseInterface;
use response\SuccessResponse;

class IndexController extends Controller
{

    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     */
    public function indexAction(): ResponseInterface
    {
        $postRepository = RepositoryStorage::getPostRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('index', [
            'posts' => $postRepository->getPostsForHomePage(),
        ]));
        return $response;
    }

}
