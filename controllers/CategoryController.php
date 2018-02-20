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

        return new SuccessResponse($this->getView()->render('categories', [
            'categories' => $categoryRepository->getAllCategories(),
        ]));

    }

    public function allPostsAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();
        return new SuccessResponse($this->getView()->render('categoryPosts', [
            'posts' => $postRepository->getPostByCategory(RequestHelper::getQueryString('id')),
        ]));
    }
}
