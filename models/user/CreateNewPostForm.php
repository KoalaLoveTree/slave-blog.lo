<?php

namespace models\User;

use models\BaseModel;
use repositories\PostRepositoryInterface;

/**
 * Class CreateNewPostForm
 * @package models\User
 */
class CreateNewPostForm extends BaseModel
{
    /** @var string */
    public $title;
    /** @var int */
    public $categoryId;
    /** @var string */
    public $content;

    /** @var PostRepositoryInterface */
    protected $postRepository;

    /**
     * CreateNewPostForm constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return bool
     */
    protected function validate(): bool
    {
        return $this->isTitleNotEmpty() && $this->isContentNotEmpty() && $this->isCategoryNotSelect();
    }

    /**
     * @return bool
     */
    protected function isTitleNotEmpty(): bool
    {
        if (empty($this->title)) {
            $this->addError('Title is empty');
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    protected function isContentNotEmpty(): bool
    {
        if (empty($this->content)) {
            $this->addError('Content is empty');
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    protected function isCategoryNotSelect(): bool
    {
        if ($this->categoryId == null) {
            $this->addError('Select category');
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function createNewPost(): bool
    {
        return $this->postRepository->createNewPost($this->title, $this->categoryId, $this->content);
    }

    public function getNewPostId(): int
    {
        return $this->postRepository->getLastPostId();
    }

}