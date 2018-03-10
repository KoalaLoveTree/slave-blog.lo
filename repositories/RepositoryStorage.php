<?php


namespace repositories;


class RepositoryStorage
{

    /** @var CategoryRepositoryInterface */
    protected static $categoryRepository;
    /** @var PostRepositoryInterface */
    protected static $postRepository;
    /** @var CommentRepositoryInterface */
    protected static $commentRepository;
    /** @var UserRepositoryInterface */
    protected static $userRepository;

    /**
     * @return CategoryRepositoryInterface
     */
    public static function getCategoryRepository(): CategoryRepositoryInterface
    {
        if (self::$categoryRepository === null) {
            self::$categoryRepository = new CategoryRepository();
        }
        return self::$categoryRepository;
    }

    /**
     * @return PostRepositoryInterface
     */
    public static function getPostRepository(): PostRepositoryInterface
    {
        if (self::$postRepository === null) {
            self::$postRepository = new PostRepository();
        }
        return self::$postRepository;
    }

    /**
     * @return CommentRepositoryInterface
     */
    public static function getCommentRepository(): CommentRepositoryInterface
    {
        if (self::$commentRepository === null) {
            self::$commentRepository = new CommentRepository();
        }
        return self::$commentRepository;
    }

    /**
     * @return UserRepositoryInterface
     */
    public static function getUserRepository(): UserRepositoryInterface
    {
        if (self::$userRepository === null) {
            self::$userRepository = new UserRepository();
        }
        return self::$userRepository;
    }


}