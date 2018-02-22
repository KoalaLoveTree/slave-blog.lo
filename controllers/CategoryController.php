<?php

namespace controllers;

use core\helper\RequestHelper;
use repositories\RepositoryStorage;
use response\SuccessResponse;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $categoryRepository = RepositoryStorage::getCategoryRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('categories', [
            'categories' => $categoryRepository->getAllCategories(),
        ]));
        return $response;

    }

    public function allPostsAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('categoryPosts', [
            'posts' => $postRepository->getPostByCategory(RequestHelper::getQueryString('id')),
        ]));
        return $response;
    }
}
