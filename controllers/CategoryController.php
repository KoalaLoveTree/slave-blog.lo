<?php

namespace controllers;

use repositories\CategoryRepository;
use repositories\PostRepository;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $catRepo = $this->createCategoryRepository();
        $categories = $catRepo->getAllCategories();
        return $this->getView()->render('categories', [
            'categories' => $categories,
        ]);

    }

    public function allPostsAction(string $first, string $second)
    {
        $postRepo = $this->createPostRepository();
        $categoryPosts = $postRepo->getPostByCategory($second);
        return $this->getView()->render('categoryPosts', [
            'posts' => $categoryPosts,
        ]);
    }

    protected function createPostRepository():PostRepository
    {
        return new PostRepository();
    }

    protected function createCategoryRepository():CategoryRepository
    {
        return new CategoryRepository();
    }
}
