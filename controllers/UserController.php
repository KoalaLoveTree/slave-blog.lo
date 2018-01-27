<?php

namespace controllers;

class UserController extends Controller
{
    public function signInAction()
    {
        return $this->getView()->render('signIn',[]);
    }

    public function signUpAction()
    {
        return $this->getView()->render('signUp',[]);
    }


}