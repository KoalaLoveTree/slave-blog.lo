<?php

namespace models\post;


use models\BaseModel;
use repositories\CommentRepositoryInterface;

class DeleteCommentForm extends BaseModel
{
    /** @var int */
    public $id;
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
     * @return bool
     */
    protected function ifCommentExist():bool
    {
        return $this->commentRepository->findCommentById($this->id);
    }

    public function deleteComment():bool
    {
        return $this->commentRepository->deleteComment($this->id);
    }
}