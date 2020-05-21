<?php


namespace controllers;

use core\helper\ErrorsCheckHelper;
use models\comment\AddCommentForm;
use models\comment\ApproveCommentForm;
use models\comment\DeleteCommentForm;
use ReflectionException;
use repositories\CommentRepositoryInterface;
use repositories\RepositoryStorage;
use response\ResponseInterface;

class CommentController extends Controller
{
    /**
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function addCommentAction(): ResponseInterface
    {
        $commentForm = $this->createAddCommentForm();
        if ($commentForm->load()) {
            if ($commentForm->isValid() && $commentForm->createNewComment()) {
                return $this->redirect('/post/show/?id=' . $commentForm->getPostId());
            }
        }
        ErrorsCheckHelper::setError('Comment must be not empty!');
    }

    /**
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function deleteCommentAction(): ResponseInterface
    {
        $commentDeleteForm = $this->createDeleteCommentForm();
        if ($commentDeleteForm->load()) {
            $path = $commentDeleteForm->getPath();
            if ($commentDeleteForm->isValid() && $commentDeleteForm->deleteComment()) {
                return $this->redirect($path);
            }
        }
    }

    /**
     * @return ResponseInterface
     * @throws ReflectionException
     */
    public function approveCommentAction(): ResponseInterface
    {
        $approveCommentForm = $this->createApproveCommentForm();
        if ($approveCommentForm->load()) {
            if ($approveCommentForm->isValid() && $approveCommentForm->approveComment()) {
                return $this->redirect('/admin/adminPanel');
            }
        }
    }


    /**
     * @return AddCommentForm
     */
    protected function createAddCommentForm(): AddCommentForm
    {
        return new AddCommentForm(
            $this->createCommentRepository()
        );
    }

    /**
     * @return DeleteCommentForm
     */
    protected function createDeleteCommentForm(): DeleteCommentForm
    {
        return new DeleteCommentForm(
            $this->createCommentRepository()
        );
    }

    /**
     * @return ApproveCommentForm
     */
    protected function createApproveCommentForm(): ApproveCommentForm
    {
        return new ApproveCommentForm(
            $this->createCommentRepository()
        );
    }

    /**
     * @return CommentRepositoryInterface
     */
    protected function createCommentRepository(): CommentRepositoryInterface
    {
        return RepositoryStorage::getCommentRepository();
    }
}
