<?php

namespace controllers;

use core\App;
use core\helper\AuthSessionHelper;
use models\User\AuthForm;
use models\User\RegistrationForm;
use repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @return string
     */
    public function signInAction()
    {
        $authForm = $this->createAuthForm();

        if ($authForm->load($this->getPost())) {
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
        if ($registrationForm->load($this->getPost())) {
            if ($registrationForm->isValid() && $registrationForm->createNewUser() && $registrationForm->login()) {
                $this->redirect('/');
            }
            return $this->renderRegistration($registrationForm->getErrorString());
        }
        return $this->renderRegistration();
    }

    public function adminAction()
    {

    }

    public function exitAction()
    {
        AuthSessionHelper::logOut();

        $this->redirect('/');
    }

    /**
     * @param string $message
     * @return string
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
     */
    protected function renderRegistration($message = '')
    {
        return $this->getView()->render('signUp', [
            'message' => $message,
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

    /**
     * @return UserRepository
     */
    protected function createUserRepository(): UserRepository
    {
        return new UserRepository();
    }

}
