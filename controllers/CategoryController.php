<?php

namespace controllers;

use core\helper\RequestHelper;
use repositories\RepositoryStorage;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $categoryRepository = RepositoryStorage::getCategoryRepository();

        return $this->getView()->render('categories', [
            'categories' => $categoryRepository->getAllCategories(),
        ]);

    }

    public function allPostsAction()
    {
        $postRepository = RepositoryStorage::getPostRepository();
        return $this->getView()->render('categoryPosts', [
            'posts' => $postRepository->getPostByCategory(RequestHelper::getQueryString('id')),
        ]);
    }
}
