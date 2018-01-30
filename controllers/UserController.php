<?php

namespace controllers;

use models\User\UserAuthorizationModel;
use repositories\UserRepository;

class UserController extends Controller
{
    public function signInAction()
    {
        return $this->getView()->render('signIn', []);
    }

    public function signUpAction()
    {
        return $this->getView()->render('signUp', []);
    }

    public function signUpButtonAction()
    {
        $userRepo = $this->createUserRepository();
        $signUp = new UserAuthorizationModel();
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
        ]);
    }

    public function signInButtonAction()
    {
        $userRepo = $this->createUserRepository();
        $signIn = new UserAuthorizationModel();
        if (isset($_POST['signInAction'])) {
            $user = $userRepo->findUserByEmail($_POST['email']);
            if ($signIn->validate($_POST['email'])) {
                if ($signIn->checkPassword($_POST['password'], $user)) {
                    if (!isset($_SESSION['userId'])) {
                        $_SESSION['userId'] = $user->getId();
                        return $this->getView()->render('validation', [
                            'message' => 'Welcome!!',
                        ]);
                    } else {
                        return $this->getView()->render('validation', [
                            'message' => 'Oops, u already in system!!!',
                        ]);
                    }

                }
                return $this->getView()->render('validation', [
                    'message' => 'Wrong E-Mail or Password',
                ]);
            }
        }
        return $this->getView()->render('validation', [
            'message' => 'Oops!!',
        ]);
    }

    public function exitAction()
    {
        session_destroy();
        return $this->getView()->render('validation', [
            'message' => 'Come back again!!',
        ]);
    }


    protected function createUserRepository(): UserRepository
    {
        return new UserRepository();
    }

}
