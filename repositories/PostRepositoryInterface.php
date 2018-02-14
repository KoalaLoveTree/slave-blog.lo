<?php
/**
 * Created by PhpStorm.
 * User: AgyKoala
 * Date: 14.02.2018
 * Time: 3:04
 */

namespace repositories;


use db\entity\Post;

interface PostRepositoryInterface
{
    /**
     * @return array
     */
    public function getPostsForHomePage(): array;

    /**
     * @param int $id
     * @return \db\entity\Entity|Post
     * @throws \core\DBPropertyNotFoundException
     */
    public function getPostById(int $id): Post;

    /**
     * @param int $categoryId
     * @return array
     */
    public function getPostByCategory(int $categoryId): array;

    /**
     * @param int $authorId
     * @return array
     */
    public function getPostsByAuthorId(int $authorId): ?array;

    /**
     * @param string $title
     * @param int $categoryId
     * @param string $content
     * @return mixed
     */
    public function createNewPost(string $title,int $categoryId,string $content);

    /**
     * @return int
     */
    public function getLastPostId(): int;
}