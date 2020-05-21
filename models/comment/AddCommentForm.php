<?php

namespace models\comment;

use core\helper\AuthSessionHelper;
use db\entity\Comment;
use models\BaseModel;
use repositories\CommentRepositoryInterface;

class AddCommentForm extends BaseModel
{
    /** @var string */
    public $comment;
    /** @var int */
    public $postId;

    /** @var CommentRepositoryInterface */
    protected $commentRepository;

    /**
     * AddCommentForm constructor.
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @return bool
     */
    protected function validate(): bool
    {
        return $this->isCommentNotEmpty();
    }

    /**
     * @return bool
     */
    protected function isCommentNotEmpty(): bool
    {
        if (empty($this->comment)) {
            $this->addError('Comment must be not empty');
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function createNewComment(): bool
    {
        return $this->commentRepository->createNewComment($this->postId, AuthSessionHelper::getId(), $this->comment, Comment::STATUS_MODERATION);
    }
}
