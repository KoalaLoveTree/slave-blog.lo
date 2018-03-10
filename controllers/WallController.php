<?php

namespace controllers;

use core\FileNotFoundException;
use core\helper\AuthSessionHelper;
use repositories\RepositoryStorage;
use response\ResponseInterface;
use response\SuccessResponse;

class WallController extends Controller
{
    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     */
    public function indexAction(): ResponseInterface
    {
        $postRepository = RepositoryStorage::getPostRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('wall', [
            'posts' => $postRepository->getPostsByAuthorId(AuthSessionHelper::getId()),
        ]));
        return $response;

    }
}
