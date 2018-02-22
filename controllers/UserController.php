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
                return $this->redirect('/');
            }
        }

        return $this->renderLogin();
    }

    public function signUpAction()
    {
        $registrationForm = $this->createRegistrationForm();
        if ($registrationForm->load()) {
            if ($registrationForm->isValid() && $registrationForm->createNewUser() && $registrationForm->login()) {
               return $this->redirect('/');
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
            $response = new SuccessResponse();
            $response->setContent($this->getView()->render('profile', [
                'currentUser' => $userRepository->findUserById(AuthSessionHelper::getId()),
                'usersPosts' => $postRepository->getPostsByAuthorId(AuthSessionHelper::getId()),
            ]));
            return $response;
        }
        ErrorsCheckHelper::setError('Sign ip please');
        return new UnauthorizedResponse();
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

        return $this->redirect('/');
    }

    /**
     * @return SuccessResponse
     * @throws \core\FileNotFoundException
     */
    protected function renderLogin()
    {
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('signIn'));
        return $response;
    }

    /**
     * @return SuccessResponse
     * @throws \core\FileNotFoundException
     */
    protected function renderRegistration()
    {
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('signUp'));
        return $response;
    }

    /**
     * @return string
     * @throws \core\FileNotFoundException
     */
    protected function renderCreateNewPost()
    {
        $categoryRepository = RepositoryStorage::getCategoryRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('createNewPost', [
            'categories' => $categoryRepository->getAllCategories(),
        ]));
        return $response;
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
