<?php

namespace repositories;


use core\DBPropertyNotFoundException;
use db\entity\Comment;

class CommentRepository extends BaseDbRepository implements CommentRepositoryInterface
{

    /**
     * @param int $postId
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getCommentsByPostId(int $postId): ?array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Comment::TABLE_NAME . ' WHERE postId = ? AND status = ' . Comment::STATUS_APPROVED . ' ORDER BY id DESC');
        $stmt->execute(array($postId));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function findCommentById(int $id): bool
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Comment::TABLE_NAME . ' WHERE id = ?');
        return $stmt->execute(array($id));
    }

    /**
     * @param int $id
     * @return bool
     */
    public function approvedComment(int $id): bool
    {
        $stmt = $this->dbConnection->prepare('UPDATE ' . Comment::TABLE_NAME . ' SET status = ' . Comment::STATUS_APPROVED . ' WHERE id = ?');
        return $stmt->execute(array($id));
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteComment(int $id): bool
    {
        $stmt = $this->dbConnection->prepare('UPDATE ' . Comment::TABLE_NAME . ' SET status = ' . Comment::STATUS_DELETED . ' WHERE id = ?');
        return $stmt->execute(array($id));
    }

    /**
     * @param int $postId
     * @param int $authorId
     * @param string $content
     * @param int $status
     * @return bool
     */
    public function createNewComment(int $postId, int $authorId, string $content, int $status): bool
    {
        $stmt = $this->dbConnection->prepare(
            'INSERT INTO ' . Comment::TABLE_NAME . ' (postId, authorId, content, status) VALUES (:postId, :authorId, :content, :status)');
        $stmt->bindParam(':postId', $postId);
        $stmt->bindParam(':authorId', $authorId);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }


    public function getEntityClassName(): string
    {
        return Comment::class;
    }

    /**
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getCommentsForModeration(): ?array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Comment::TABLE_NAME . ' WHERE status = ' . Comment::STATUS_MODERATION);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }
}