<?php

namespace controllers;

use core\FileNotFoundException;
use core\helper\AuthSessionHelper;
use core\helper\ErrorsCheckHelper;
use models\User\AuthForm;
use models\Post\CreateNewPostForm;
use models\User\RegistrationForm;
use ReflectionException;
use repositories\CategoryRepositoryInterface;
use repositories\PostRepositoryInterface;
use repositories\RepositoryStorage;
use repositories\UserRepositoryInterface;
use response\ResponseInterface;
use response\SuccessResponse;
use response\UnauthorizedResponse;

class UserController extends Controller
{
    /**
     * @return ResponseInterface
     * @throws ReflectionException
     * @throws FileNotFoundException
     */
    public function signInAction(): ResponseInterface
    {
        $authForm = $this->createAuthForm();

        if ($authForm->load()) {
            if ($authForm->isValid() && $authForm->login()) {
                return $this->redirect('/');
            }
        }

        return $this->renderLogin();
    }

    /**
     * @return ResponseInterface
     * @throws ReflectionException
     * @throws FileNotFoundException
     */
    public function signUpAction(): ResponseInterface
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

    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     */
    public function profileAction(): ResponseInterface
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

    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     * @throws ReflectionException
     */
    public function createNewPostAction(): ResponseInterface
    {
        $createNewPostForm = $this->createCreateNewPostForm();
        if ($createNewPostForm->load()) {
            if ($createNewPostForm->isValid() && $createNewPostForm->createNewPost()) {
                return $this->redirect('/post/show/?id=' . $createNewPostForm->getNewPostId());
            }
            return $this->renderCreateNewPost();
        }
        return $this->renderCreateNewPost();
    }

    /**
     * @return ResponseInterface
     */
    public function exitAction(): ResponseInterface
    {
        AuthSessionHelper::logOut();

        return $this->redirect('/');
    }

    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     */
    protected function renderLogin(): ResponseInterface
    {
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('signIn'));
        return $response;
    }

    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     */
    protected function renderRegistration(): ResponseInterface
    {
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('signUp'));
        return $response;
    }

    /**
     * @return ResponseInterface
     * @throws FileNotFoundException
     */
    protected function renderCreateNewPost(): ResponseInterface
    {
        $categoryRepository = $this->createCategoryRepository();
        $response = new SuccessResponse();
        $response->setContent($this->getView()->render('createNewPost', [
            'categories' => $categoryRepository->getAllCategories(),
        ]));
        return $response;
    }

    /**
     * @return AuthForm
     */
    protected function createAuthForm(): AuthForm
    {
        return new AuthForm(
            $this->createUserRepository()
        );
    }

    /**
     * @return RegistrationForm
     */
    protected function createRegistrationForm(): RegistrationForm
    {
        return new RegistrationForm(
            $this->createUserRepository()
        );
    }

    /**
     * @return CreateNewPostForm
     */
    protected function createCreateNewPostForm(): CreateNewPostForm
    {
        return new CreateNewPostForm(
            $this->createPostRepository()
        );
    }

    /**
     * @return UserRepositoryInterface
     */
    protected function createUserRepository(): UserRepositoryInterface
    {
        return RepositoryStorage::getUserRepository();
    }

    /**
     * @return PostRepositoryInterface
     */
    protected function createPostRepository(): PostRepositoryInterface
    {
        return RepositoryStorage::getPostRepository();
    }

    /**
     * @return CategoryRepositoryInterface
     */
    protected function createCategoryRepository(): CategoryRepositoryInterface
    {
        return RepositoryStorage::getCategoryRepository();
    }

}
