<?php
namespace models\post;

use models\BaseModel;
use repositories\CommentRepositoryInterface;

class AddCommentForm extends BaseModel
{
    /** @var string */
    public $comment;

    /** @var CommentRepositoryInterface */
    protected $commentRepository;
    /** @var int */
    protected $postId;
    /** @var int */
    protected $authorId;

    /**
     * AddCommentForm constructor.
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param int $postId
     */
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    /**
     * @param int $authorId
     */
    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
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
        if (empty($this->comment)){
            $this->addError('Comment must be not empty');
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function createNewComment() :bool
    {
        return $this->commentRepository->createNewComment($this->postId, $this->authorId, $this->comment);
    }
}