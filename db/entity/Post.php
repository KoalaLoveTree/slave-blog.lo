<?php

namespace db\entity;

use repositories\RepositoryStorage;

class Post implements Entity
{

    const TABLE_NAME = 'post';

    /**@var int* */
    private $id;

    /**@var int* */
    private $categoryId;

    /**@var int* */
    private $authorId;

    /**@var string* */
    private $title;

    /**@var string* */
    private $content;

    /**@var string* */
    private $pubdate;

    /** @var User */
    private $author;

    /** @var Category */
    private $category;

    /** @var Comment[] */
    private $comments;

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
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
    public function getPubdate(): string
    {
        return $this->pubdate;
    }

    /**
     * @param string $pubdate
     */
    public function setPubdate(string $pubdate): void
    {
        $this->pubdate = $pubdate;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        if ($this->author === null) {
            $this->author = RepositoryStorage::getUserRepository()->findUserById($this->getAuthorId());
        }
        return $this->author;
    }


    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        if ($this->category === null) {
            $this->category = RepositoryStorage::getCategoryRepository()->getCategoryById($this->getCategoryId());
        }
        return $this->category;
    }

    /**
     * @return Comment[]
     */
    public function getComments(): array
    {
        if ($this->comments === null){
            $this->comments = RepositoryStorage::getCommentRepository()->getCommentsByPostId($this->getId());
        }
        return $this->comments;
    }
}
