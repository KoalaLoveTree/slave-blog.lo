<?php

namespace controllers;

use core\helper\AuthSessionHelper;
use models\User\AuthForm;
use models\User\CreateNewPostForm;
use models\User\RegistrationForm;
use repositories\CategoryRepository;
use repositories\PostRepository;
use repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @return string
     * @throws \ReflectionException
     * @throws \core\FileNotFoundException
     */
    public function signInAction()
    {
        $authForm = $this->createAuthForm();

        if ($authForm->load()) {
            if ($authForm->isValid() && $authForm->login()) {
                $this->redirect('/');
            }

            return $this->renderLogin($authForm->getErrorString());
        }

        return $this->renderLogin();
    }

    public function signUpAction()
    {
        $registrationForm = $this->createRegistrationForm();
        if ($registrationForm->load()) {
            if ($registrationForm->isValid() && $registrationForm->createNewUser() && $registrationForm->login()) {
                $this->redirect('/');
            }
            return $this->renderRegistration($registrationForm->getErrorString());
        }
        return $this->renderRegistration();
    }

    public function profileAction()
    {
        $userRepo = $this->createUserRepository();
        $postRepo = $this->createPostRepository();
        if (AuthSessionHelper::isLoggedIn()) {
            $user = $userRepo->findUserById(AuthSessionHelper::getId());
            $usersPosts = $postRepo->getPostsByAuthorId(AuthSessionHelper::getId());
            return $this->getView()->render('profile', [
                'u' => $user,
                'usersPosts' => $usersPosts,
            ]);
        }
        die('Sign in please!');
    }

    public function createNewPostAction()
    {
        $createNewPostForm = $this->createCreateNewPostForm();
        if ($createNewPostForm->load()) {
            if ($createNewPostForm->isValid() && $createNewPostForm->createNewPost()) {
                $this->redirect('/post/show/?id=' . $createNewPostForm->getNewPostId());
            }
            return $this->renderCreateNewPost($createNewPostForm->getErrorString());
        }
        return $this->renderCreateNewPost();
    }

    public function exitAction()
    {
        AuthSessionHelper::logOut();

        $this->redirect('/');
    }

    /**
     * @param string $message
     * @return string
     * @throws \core\FileNotFoundException
     */
    protected function renderLogin($message = '')
    {
        return $this->getView()->render('signIn', [
            'message' => $message,
        ]);
    }

    /**
     * @param string $message
     * @return string
     * @throws \core\FileNotFoundException
     */
    protected function renderRegistration($message = '')
    {
        return $this->getView()->render('signUp', [
            'message' => $message,
        ]);
    }

    protected function renderCreateNewPost($message = '')
    {
        $categoryRepo = $this->createCategoryRepository();
        $categories = $categoryRepo->getAllCategories();
        return $this->getView()->render('createNewPost', [
            'message' => $message,
            'categories' => $categories,
        ]);
    }

    /**
     * @return AuthForm
     */
    protected function createAuthForm()
    {
        return new AuthForm(
            $this->createUserRepository()
        );
    }

    /**
     * @return RegistrationForm
     */
    protected function createRegistrationForm()
    {
        return new RegistrationForm(
            $this->createUserRepository()
        );
    }

    protected function createCreateNewPostForm()
    {
        return new CreateNewPostForm(
            $this->createPostRepository()
        );
    }

    /**
     * @return UserRepository
     */
    protected function createUserRepository(): UserRepository
    {
        return new UserRepository();
    }

    protected function createPostRepository(): PostRepository
    {
        return new PostRepository();
    }

    protected function createCategoryRepository(): CategoryRepository
    {
        return new CategoryRepository();
    }
}
