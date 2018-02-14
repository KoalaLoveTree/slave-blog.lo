<?php

namespace repositories;


use core\helper\AuthSessionHelper;
use db\entity\Post;

class PostRepository extends BaseDbRepository implements PostRepositoryInterface
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
    public function getPostsByAuthorId(int $authorId): ?array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM post WHERE authorId = ?');
        $stmt->execute(array($authorId));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    /**
     * @param string $title
     * @param int $categoryId
     * @param string $content
     * @return bool|mixed
     */
    public function createNewPost(string $title, int $categoryId, string $content)
    {
        $stmt = $this->dbConnection->prepare(
            'INSERT INTO post (authorId, categoryId, title, content) VALUES (:authorId, :categoryId, :title, :content)');
        $stmt->bindParam(':authorId',AuthSessionHelper::getId() );
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);

        return $stmt->execute();
    }

    /**
     * @return int
     */
    public function getLastPostId(): int
    {
        $stmt = $this->dbConnection->prepare('SELECT id FROM post ORDER BY id DESC LIMIT 1');
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result[0]['id'];
    }

    public function getEntityClassName(): string
    {
        return Post::class;
    }
}