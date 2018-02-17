<?php


namespace controllers;

use models\comment\AddCommentForm;
use models\comment\ApproveCommentForm;
use models\comment\DeleteCommentForm;
use repositories\RepositoryStorage;

class CommentController extends Controller
{
    public function addCommentAction()
    {
        $commentForm = $this->createAddCommentForm();
        if ($commentForm->load()) {
            if ($commentForm->isValid() && $commentForm->createNewComment()) {
               $this->redirect('/post/show/?id=' . $commentForm->getPostId());
               return;
            }
        }
    }

    public function deleteCommentAction()
    {
        $commentDeleteForm = $this->createDeleteCommentForm();
        if ($commentDeleteForm->load()) {
            $path = $commentDeleteForm->getPath();
            if ($commentDeleteForm->isValid() && $commentDeleteForm->deleteComment()) {
                $this->redirect($path);
                return;
            }
        }
    }

    public function approveCommentAction()
    {
     $approveCommentForm = $this->createApproveCommentForm();
     if ($approveCommentForm->load()){
         if ($approveCommentForm->isValid() && $approveCommentForm->approveComment()) {
             $this->redirect('/admin/adminPanel');
             return;
         }
     }
    }


    protected function createAddCommentForm()
    {
        return new AddCommentForm(
            RepositoryStorage::getCommentRepository()
        );
    }

    protected function createDeleteCommentForm()
    {
        return new DeleteCommentForm(
            RepositoryStorage::getCommentRepository()
        );
    }

    protected function createApproveCommentForm()
    {
        return new ApproveCommentForm(
            RepositoryStorage::getCommentRepository()
        );
    }
}