<?php

namespace controllers;

use core\helper\AuthSessionHelper;
use models\User\AuthForm;
use models\Post\CreateNewPostForm;
use models\User\RegistrationForm;
use repositories\CategoryRepository;
use repositories\PostRepository;
use repositories\RepositoryStorage;
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

            return $this->renderLogin();
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
            return $this->renderRegistration();
        }
        return $this->renderRegistration();
    }

    public function profileAction()
    {
        $userRepository = RepositoryStorage::getUserRepository();
        $postRepository = RepositoryStorage::getPostRepository();
        if (AuthSessionHelper::isLoggedIn()) {
            return $this->getView()->render('profile', [
                'currentUser' => $userRepository->findUserById(AuthSessionHelper::getId()),
                'usersPosts' => $postRepository->getPostsByAuthorId(AuthSessionHelper::getId()),
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
            return $this->renderCreateNewPost();
        }
        return $this->renderCreateNewPost();
    }

    public function exitAction()
    {
        AuthSessionHelper::logOut();

        $this->redirect('/');
    }

    /**
     * @return string
     * @throws \core\FileNotFoundException
     */
    protected function renderLogin()
    {
        return $this->getView()->render('signIn');
    }

    /**
     * @return string
     * @throws \core\FileNotFoundException
     */
    protected function renderRegistration()
    {
        return $this->getView()->render('signUp');
    }

    /**
     * @return string
     * @throws \core\FileNotFoundException
     */
    protected function renderCreateNewPost()
    {
        $categoryRepository = RepositoryStorage::getCategoryRepository();
        return $this->getView()->render('createNewPost', [
            'categories' => $categoryRepository->getAllCategories(),
        ]);
    }

    /**
     * @return AuthForm
     */
    protected function createAuthForm()
    {
        return new AuthForm(
            RepositoryStorage::getUserRepository()
        );
    }

    /**
     * @return RegistrationForm
     */
    protected function createRegistrationForm()
    {
        return new RegistrationForm(
            RepositoryStorage::getUserRepository()
        );
    }

    protected function createCreateNewPostForm()
    {
        return new CreateNewPostForm(
            RepositoryStorage::getPostRepository()
        );
    }
}
