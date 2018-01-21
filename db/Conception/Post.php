<?php

namespace db\conception;

class Post
{

    const TABLE_NAME = 'post';

    /**@var int**/
    private $id;

    /**@var int**/
    private $category_id;

    /**@var int**/
    private $author_id;

    /**@var string**/
    private $title;

    /**@var string**/
    private $content;

    /**@var string**/
    private $pubdate;

    /**
     * Post constructor.
     * @param int $category_id
     * @param int $author_id
     * @param string $title
     * @param string $content
     * @param string $pubdate
     */
    public function __construct(int $category_id, int $author_id, string $title, string $content, string $pubdate)
    {
        $this->category_id = $category_id;
        $this->author_id = $author_id;
        $this->title = $title;
        $this->content = $content;
        $this->pubdate = $pubdate;
    }


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
        return $this->category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    /**
     * @param int $author_id
     */
    public function setAuthorId(int $author_id): void
    {
        $this->author_id = $author_id;
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



}