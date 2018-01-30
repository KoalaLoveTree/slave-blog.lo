<?php

namespace controllers;

use repositories\CategoryRepository;
use repositories\PostRepository;
use repositories\UserRepository;

class PostController extends Controller
{
    public function showAction(string $name, string $id)
    {
        $postRepo = $this->createPostRepository();
        $post = $postRepo->getPostById((int)$id);
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
