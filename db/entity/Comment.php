<?php

namespace db\entity;

use repositories\RepositoryStorage;

class Comment implements Entity
{

    const TABLE_NAME = 'comment';

    /**@var int* */
    private $id;

    /**@var int* */
    private $postId;

    /**@var int* */
    private $authorId;

    /**@var string* */
    private $content;

    /**@var string* */
    private $pubtime;

    /** @var User */
    private $author;

    /** @var int */
    private $status;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     */
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @param int $authorId
     */
    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getPubtime(): string
    {
        return $this->pubtime;
    }

    /**
     * @param string $pubtime
     */
    public function setPubtime(string $pubtime): void
    {
        $this->pubtime = $pubtime;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        if ($this->author === null) {
            $this->author = RepositoryStorage::getUserRepository()->findUserById($this->authorId);
        }
        return $this->author;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}
