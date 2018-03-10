<?php

namespace repositories;


use core\DBPropertyNotFoundException;
use db\entity\Entity;

interface PostRepositoryInterface
{
    /**
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getPostsForHomePage(): ?array;

    /**
     * @param int $id
     * @return Entity|null
     * @throws DBPropertyNotFoundException
     */
    public function getPostById(int $id): ?Entity;

    /**
     * @param int $categoryId
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getPostByCategory(int $categoryId): ?array;

    /**
     * @param int $authorId
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getPostsByAuthorId(int $authorId): ?array;

    /**
     * @param string $title
     * @param int $categoryId
     * @param string $content
     * @return bool
     */
    public function createNewPost(string $title, int $categoryId, string $content): bool;

    /**
     * @return int|null
     */
    public function getLastPostId(): ?int;

    /**
     * @return array
     * @throws DBPropertyNotFoundException
     */
    public function getAllPosts(): ?array;
}
