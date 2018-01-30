<?php

namespace controllers;

use models\User\AuthForm;
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
                return $this->renderLogin('Welcome!');
            }

            return $this->renderLogin($authForm->getErrorString());
        }

        return $this->renderLogin();
    }

    public function signUpAction()
    {
        return $this->getView()->render('signUp', []);
    }

    public function signUpButtonAction()
    {
       /* $userRepo = $this->createUserRepository();
        $signUp = new AuthForm();
        if (isset($_POST['signUpAction'])) {
            if ($signUp->validate($_POST['email'])) {
                if ($userRepo->createNewUser()) {
                    if (!isset($_SESSION['userId'])) {
                        $_SESSION['userId'] = $userRepo->findUserByEmail($_POST['email'])->getId();
                        return $this->getView()->render('validation', [
                            'message' => 'Welcome!!',
                        ]);
                    } else {
                        return $this->getView()->render('validation', [
                            'message' => 'Oops, u already in system!!!',
                        ]);
                    }
                } else {
                    return $this->getView()->render('validation', [
                        'message' => 'User Always Exist',
                    ]);
                }
            }
            return $this->getView()->render('validation', [
                'message' => 'Invalid E-Mail',
            ]);
        }
        return $this->getView()->render('validation', [
            'message' => 'Oops!!',
        ]);*/
    }

    public function exitAction()
    {
        session_destroy();

        return $this->getView()->render('validation', [
            'message' => 'Come back again!!',
        ]);
    }

    /**
     * @return string
     */
    protected function renderLogin($message = '')
    {
        return $this->getView()->render('signIn', [
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
     * @return UserRepository
     */
    protected function createUserRepository(): UserRepository
    {
        return new UserRepository();
    }

}
