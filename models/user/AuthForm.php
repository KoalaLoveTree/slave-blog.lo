<?php

namespace models\User;

use core\helper\AuthSessionHelper;
use db\entity\User;
use models\BaseModel;
use repositories\UserRepositoryInterface;

/**
 * Class AuthForm
 * @package models\User
 */
class AuthForm extends BaseModel
{
    /** @var string */
    public $password;

    /** @var string */
    public $email;

    /** @var UserRepositoryInterface */
    protected $userRepository;

    /** @var User */
    protected $user = null;

    /**
     * AuthForm constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return bool
     */
    protected function validate(): bool
    {
        return $this->isEmailValid() && $this->isPasswordValid();
    }

    /**
     * @return User
     */
    protected function getUser()
    {
        if (!$this->user) {
            $this->user = $this->userRepository->findUserByEmail($this->email);
        }

        return $this->user;
    }

    /**
     * @return bool
     */
    protected function isEmailValid(): bool
    {
        $valid = filter_var($this->email, FILTER_VALIDATE_EMAIL);

        if (!$valid) {
            $this->addError('Email is not valid');
        }

        return $valid;
    }

    /**
     * @return bool
     */
    protected function isPasswordValid(): bool
    {
        if (!$this->getUser()) {
            $this->addError('User is not exist');
            return false;
        }

        if (!password_verify($this->password, $this->getUser()->getPassword())) {
            $this->addError('Password is invalid');
            return false;
        }

        return true;
    }


    /**
     * @return bool
     */
    public function login(): bool
    {
        AuthSessionHelper::login($this->getUser());

        return true;
    }
}
