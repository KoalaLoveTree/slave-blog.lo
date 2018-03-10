<?php

namespace controllers;

use core\DBPropertyNotFoundException;
use core\FileNotFoundException;
use core\helper\RequestHelper;

use repositories\RepositoryStorage;
use response\ResponseInterface;
use response\SuccessResponse;

class PostController extends Controller
{
    /**
     * @return ResponseInterface
     * @throws DBPropertyNotFoundException
     * @throws FileNotFoundException
     */
    public function showAction():ResponseInterface
    {
        $postRepository = RepositoryStorage::getPostRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('post', [
            'post' => $postRepository->getPostById(RequestHelper::getQueryString('id')),
        ]));
        return $response;
    }
}
