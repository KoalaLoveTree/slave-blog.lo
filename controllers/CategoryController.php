<?php

namespace controllers;

use core\FileNotFoundException;
use core\helper\RequestHelper;
use repositories\CategoryRepositoryInterface;
use repositories\RepositoryStorage;
use response\ResponseInterface;
use response\SuccessResponse;

class CategoryController extends Controller
{
    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     */
    public function indexAction(): ResponseInterface
    {
        $categoryRepository = RepositoryStorage::getCategoryRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('categories', [
            'categories' => $categoryRepository->getAllCategories(),
        ]));
        return $response;

    }

    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     */
    public function allPostsAction(): ResponseInterface
    {
        $postRepository = RepositoryStorage::getPostRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('categoryPosts', [
            'posts' => $postRepository->getPostByCategory(RequestHelper::getQueryString('id')),
        ]));
        return $response;
    }

    /**
     * @return CategoryRepositoryInterface
     */
    protected function createCategoryRepository(): CategoryRepositoryInterface
    {
        return RepositoryStorage::getCategoryRepository();
    }
}
