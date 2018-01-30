<?php

namespace repositories;


use db\entity\Post;

class PostRepository extends BaseDbRepository
{
    /**
     * @return array
     */
    public function getPostsForHomePage(): array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM post ORDER BY id DESC LIMIT 3');
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    /**
     * @param int $id
     * @return \db\entity\Entity|Post
     * @throws \core\DBPropertyNotFoundException
     */
    public function getPostById(int $id): Post
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM post WHERE id = ?');
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $post = new Post();
        return $this->arrayToEntity($result[0], $post);
    }

    /**
     * @param int $categoryId
     * @return array
     */
    public function getPostByCategory(int $categoryId): array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM post WHERE categoryId = ?');
        $stmt->execute(array($categoryId));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    /**
     * @param int $authorId
     * @return array
     */
    public function getPostsByAuthorId(int $authorId): array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM post WHERE authorId = ?');
        $stmt->execute(array($authorId));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    public function getEntityClassName(): string
    {
        return Post::class;
    }
}