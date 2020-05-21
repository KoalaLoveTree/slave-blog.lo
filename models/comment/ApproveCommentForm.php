<?php


namespace models\comment;


use models\BaseModel;
use repositories\CommentRepositoryInterface;

class ApproveCommentForm extends BaseModel
{

    /** @var int  */
    public $id;

    /** @var CommentRepositoryInterface */
    protected $commentRepository;

    /**
     * ApproveCommentForm constructor.
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }


    /**
     * @return bool
     */
    protected function validate(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function approveComment():bool
    {
        return $this->commentRepository->approvedComment($this->id);
    }
}
