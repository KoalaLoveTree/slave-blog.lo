<?php

namespace repositories;


interface CommentRepositoryInterface
{
    /**
     * @param int $postId
     * @return array
     */
    public function getCommentsByPostId(int $postId): array;

    /**
     * @param int $id
     * @return bool
     */
    public function findCommentById(int $id):bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteComment(int $id):bool;

    /**
     * @param int $postId
     * @param int $authorId
     * @param string $content
     * @param int $status
     * @return bool|mixed
     */
    public function createNewComment(int $postId, int $authorId, string $content, int $status);

    /**
     * @param int $id
     * @return bool
     */
    public function approvedComment(int $id): bool;

    /**
     * @return array
     */
    public function getCommentsForModeration():array;
}