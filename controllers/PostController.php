<?php

namespace controllers;

use repositories\CategoryRepository;
use repositories\PostRepository;
use repositories\UserRepository;
use route\ParseParams;

class PostController extends Controller
{
    public function showAction()
    {

        $postRepo = $this->createPostRepository();
        $id = (int)ParseParams::getParams(['0'=>'id'])['id'];
        $post = $postRepo->getPostById($id);
        $userRepo = $this->createUserRepository();
        $author = $userRepo->findUserById((int)$post->getAuthorId());
        $categoryRepo = $this->createCategoryRepository();
        $category = $categoryRepo->getCategoryById((int)$post->getCategoryId());

        return $this->getView()->render('post', [
            'author' => $author,
            'category' => $category,
            'post' => $post,
        ]);
    }

    /**
     * @return PostRepository
     */
    protected function createPostRepository(): PostRepository
    {
        return new PostRepository();
    }

    /**
     * @return UserRepository
     */
    protected function createUserRepository(): UserRepository
    {
        return new UserRepository();
    }

    /**
     * @return CategoryRepository
     */
    protected function createCategoryRepository(): CategoryRepository
    {
        return new CategoryRepository();
    }
}
