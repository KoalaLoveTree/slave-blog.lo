<?php

namespace controllers;

use repositories\CategoryRepository;
use repositories\PostRepository;
use route\ParseParams;

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

    public function allPostsAction()
    {
        $postRepo = $this->createPostRepository();
        $id = (int)ParseParams::getParams(['0'=>'id'])['id'];
        $categoryPosts = $postRepo->getPostByCategory($id);
        return $this->getView()->render('categoryPosts', [
            'posts' => $categoryPosts,
        ]);
    }

    protected function createPostRepository(): PostRepository
    {
        return new PostRepository();
    }

    protected function createCategoryRepository(): CategoryRepository
    {
        return new CategoryRepository();
    }
}
