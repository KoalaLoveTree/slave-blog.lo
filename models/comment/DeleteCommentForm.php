<?php

namespace models\comment;


use models\BaseModel;
use repositories\CommentRepositoryInterface;

class DeleteCommentForm extends BaseModel
{
    /** @var int */
    public $id;
    /** @var int */
    public $postId;
    /** @var string */
    public $path;


    /** @var CommentRepositoryInterface */
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @return bool
     */
    protected function validate(): bool
    {
        return $this->ifCommentExist();
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->choosePath();
    }

    /**
     * @return string
     */
    protected function choosePath():string
    {
        switch ($this->path){
            case 0:
                return '/post/show/?id=' . $this->getPostId();
                break;
            case 1:
                return '/admin/adminPanel';
                break;
        }
    }

    /**
     * @return bool
     */
    protected function ifCommentExist():bool
    {
        return $this->commentRepository->findCommentById($this->id);
    }

    /**
     * @return bool
     */
    public function deleteComment():bool
    {
        return $this->commentRepository->deleteComment($this->id);
    }
}
