<?php

namespace controllers;

use core\helper\AuthSessionHelper;
use core\helper\ErrorsCheckHelper;
use models\User\AuthForm;
use models\Post\CreateNewPostForm;
use models\User\RegistrationForm;
use repositories\RepositoryStorage;
use response\ResponseInterface;
use response\SuccessResponse;
use response\UnauthorizedResponse;

class UserController extends Controller
{
    /**
     * @return ResponseInterface
     * @throws \ReflectionException
     * @throws \core\FileNotFoundException
     */
    public function signInAction()
    {
        $authForm = $this->createAuthForm();

        if ($authForm->load()) {
            if ($authForm->isValid() && $authForm->login()) {
                return new SuccessResponse('Welcome!',['Location: /',]);
            }
            ErrorsCheckHelper::setError('Wrong login or password');
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
            return new SuccessResponse($this->getView()->render('profile', [
                'currentUser' => $userRepository->findUserById(AuthSessionHelper::getId()),
                'usersPosts' => $postRepository->getPostsByAuthorId(AuthSessionHelper::getId()),
            ]));
        }
        return new UnauthorizedResponse('Sign up please!');
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
     * @return SuccessResponse
     * @throws \core\FileNotFoundException
     */
    protected function renderLogin()
    {
        return new SuccessResponse($this->getView()->render('signIn'));
    }

    /**
     * @return SuccessResponse
     * @throws \core\FileNotFoundException
     */
    protected function renderRegistration()
    {
        return new SuccessResponse($this->getView()->render('signUp'));
    }

    /**
     * @return string
     * @throws \core\FileNotFoundException
     */
    protected function renderCreateNewPost()
    {
        $categoryRepository = RepositoryStorage::getCategoryRepository();
        return new SuccessResponse($this->getView()->render('createNewPost', [
            'categories' => $categoryRepository->getAllCategories(),
        ]));
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
