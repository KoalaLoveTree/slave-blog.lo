<?php

namespace db\entity;

class Comment implements Entity
{

    const TABLE_NAME = 'comment';

    /**@var int**/
    private $id;

    /**@var int**/
    private $post_id;

    /**@var int**/
    private $author_id;

    /**@var string**/
    private $content;

    /**@var string**/
    private $pubtime;

    /**
     * Comment constructor.
     * @param int $post_id
     * @param int $author_id
     * @param string $content
     * @param string $pubtime
     */
    public function __construct(int $post_id, int $author_id, string $content, string $pubtime)
    {
        $this->post_id = $post_id;
        $this->author_id = $author_id;
        $this->content = $content;
        $this->pubtime = $pubtime;
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
    public function getPostId(): int
    {
        return $this->post_id;
    }

    /**
     * @param int $post_id
     */
    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
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



}