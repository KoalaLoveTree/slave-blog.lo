<?php

namespace repositories;


use core\DBPropertyNotFoundException;
use core\helper\AuthSessionHelper;
use db\entity\Entity;
use db\entity\Post;

class PostRepository extends BaseDbRepository implements PostRepositoryInterface
{
    /**
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getPostsForHomePage(): ?array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Post::TABLE_NAME . ' ORDER BY id DESC LIMIT 3');
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    /**
     * @param int $id
     * @return Entity|null
     * @throws DBPropertyNotFoundException
     */
    public function getPostById(int $id): ?Entity
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Post::TABLE_NAME . ' WHERE id = ?');
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $post = new Post();
        return $this->arrayToEntity($result[0], $post);
    }

    /**
     * @param int $categoryId
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getPostByCategory(int $categoryId): ?array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Post::TABLE_NAME . ' WHERE categoryId = ?');
        $stmt->execute(array($categoryId));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    /**
     * @param int $authorId
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getPostsByAuthorId(int $authorId): ?array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Post::TABLE_NAME . ' WHERE authorId = ?');
        $stmt->execute(array($authorId));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    /**
     * @param string $title
     * @param int $categoryId
     * @param string $content
     * @return bool
     */
    public function createNewPost(string $title, int $categoryId, string $content): bool
    {
        $stmt = $this->dbConnection->prepare(
            'INSERT INTO ' . Post::TABLE_NAME . ' (authorId, categoryId, title, content) VALUES (:authorId, :categoryId, :title, :content)');
        $stmt->bindParam(':authorId', AuthSessionHelper::getId());
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);

        return $stmt->execute();
    }

    /**
     * @return int|null
     */
    public function getLastPostId(): ?int
    {
        $stmt = $this->dbConnection->prepare('SELECT id FROM ' . Post::TABLE_NAME . ' ORDER BY id DESC LIMIT 1');
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result[0]['id'];
    }

    /**
     * @return array
     * @throws DBPropertyNotFoundException
     */
    public function getAllPosts(): ?array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Post::TABLE_NAME);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    /**
     * @return string
     */
    public function getEntityClassName(): string
    {
        return Post::class;
    }
}
