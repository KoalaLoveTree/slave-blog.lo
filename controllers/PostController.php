<?php

namespace controllers;

use core\helper\AuthSessionHelper;
use db\entity\Category;
use db\entity\Post;
use db\entity\User;
use models\post\AddCommentForm;
use models\post\DeleteCommentForm;
use repositories\CategoryRepository;
use repositories\CommentRepository;
use repositories\PostRepository;
use repositories\UserRepository;
use route\ParseParams;

class PostController extends Controller
{
    public function showAction()
    {
        $postRepo = $this->createPostRepository();
        $id = (int)ParseParams::getParams(['0' => 'id'])['id'];
        $post = $postRepo->getPostById($id);
        $userRepo = $this->createUserRepository();
        $author = $userRepo->findUserById((int)$post->getAuthorId());
        $categoryRepo = $this->createCategoryRepository();
        $category = $categoryRepo->getCategoryById((int)$post->getCategoryId());
        $commentRepo = $this->createCommentRepository();
        $comments = $commentRepo->getCommentsByPostId($id);
        $commentForm = $this->createAddCommentForm();
        $commentDeleteForm = $this->createDeleteCommentForm();
        $authorsOfComments = [];
        foreach ($comments as $comment) {
                $authorsOfComments[$comment->getId()] = $userRepo->findUserById($comment->getAuthorId())->getLogin();
        }
        if ($commentDeleteForm->load()){
            if ($commentDeleteForm->isValid()&& $commentDeleteForm->deleteComment()){
                $this->redirect('/post/show/?id='.$id);
            }
            return $this->renderPost($commentDeleteForm->getErrorString(), $author, $category, $post, $comments,$authorsOfComments);
        }
        if ($commentForm->load()) {
            $commentForm->setPostId($post->getId());
            $commentForm->setAuthorId((int)AuthSessionHelper::getId());
            if ($commentForm->isValid() && $commentForm->createNewComment()) {
                $this->redirect('/post/show/?id='.$id);
            }
            return $this->renderPost($commentForm->getErrorString(), $author, $category, $post, $comments,$authorsOfComments);
        }
        return $this->renderPost('', $author, $category, $post, $comments,$authorsOfComments);
    }

    public function deleteCommentAction()
    {

    }

    /**
     * @return CommentRepository
     */
    protected function createCommentRepository(): CommentRepository
    {
        return new CommentRepository();
    }

    /**
     * @return PostRepository
     */
    protected function createPostRepository(): PostRepository
    {
        return new PostRepository();
    }

    /**
     * @return UserRepository
     */
    protected function createUserRepository(): UserRepository
    {
        return new UserRepository();
    }

    /**
     * @return CategoryRepository
     */
    protected function createCategoryRepository(): CategoryRepository
    {
        return new CategoryRepository();
    }

    /**
     * @return AddCommentForm
     */
    protected function createAddCommentForm()
    {
        return new AddCommentForm(
            $this->createCommentRepository()
        );
    }

    /**
     * @param string $message
     * @param User $author
     * @param Category $category
     * @param Post $post
     * @param array $comments
     * @param array $authorsOfComments
     * @return string
     * @throws \core\FileNotFoundException
     */
    protected function renderPost($message = '', User $author, Category $category, Post $post, array $comments, array $authorsOfComments)
    {
        return $this->getView()->render('post', [
            'message' => $message,
            'author' => $author,
            'category' => $category,
            'post' => $post,
            'comments' => $comments,
            'authorsOfComments' => $authorsOfComments,
        ]);
    }

    protected function createDeleteCommentForm()
    {
        return new DeleteCommentForm(
            $this->createCommentRepository()
        );
    }
}
