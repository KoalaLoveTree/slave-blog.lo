<?php

namespace controllers;

use models\User\UserAuthorizationModel;

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
        $signUp = new UserAuthorizationModel();
        if (isset($_POST['signUpAction'])) {
            if ($signUp->validate($_POST['email'])) {
                if ($signUp->addNewUser() != null ) {
                    return $this->getView()->render('validation',[
                        'message' => 'Registration Success',
                    ]);
                }else{
                    return $this->getView()->render('validation',[
                        'message' => 'User Always Exist',
                    ]);
                }
            } else {
                return $this->getView()->render('validation',[
                    'message' => 'Invalid E-Mail',
                ]);
            }
        }
    }

    public function signInButtonAction()
    {
        $signIn = new UserAuthorizationModel();
        if (isset($_POST['signInAction'])) {
            if ($signIn->validate($_POST['email'])) {
                if ($signIn->checkPassword() == 0) {
                    return $this->getView()->render('validation',[
                        'message' => 'Welcome!!!',
                    ]);
                } elseif ($signIn->checkPassword() == 1) {
                    return $this->getView()->render('validation',[
                        'message' => 'Wrong E-Mail',
                    ]);
                } elseif ($signIn->checkPassword() == 2) {
                    return $this->getView()->render('validation',[
                        'message' => 'Wrong Password',
                    ]);
                }
            }
        }
    }


}