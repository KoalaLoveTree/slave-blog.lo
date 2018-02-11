<?php
/**
 * Created by PhpStorm.
 * User: AgyKoala
 * Date: 31.01.2018
 * Time: 0:34
 */

namespace models\User;

use core\helper\AuthSessionHelper;
use db\entity\User;
use models\BaseModel;
use repositories\UserRepositoryInterface;

/**
 * Class RegistrationForm
 * @package models\User
 */
class RegistrationForm extends BaseModel
{
    /** @var string */
    public $password;

    /** @var string */
    public $email;
    /** @var string */
    public $login;

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
        return $this->isEmailValid() && $this->isEmailNotExist();
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
    protected function isEmailNotExist(): bool
    {
        if ($this->getUser()) {
            $this->addError('Email is already exist');
            return false;
        }
        return true;
    }
    
    /**
     * @return bool
     */
    protected function isEmailValid():bool
    {
        $valid = filter_var($this->email, FILTER_VALIDATE_EMAIL);

        if (!$valid) {
            $this->addError('Email is invalid');
        }
        return $valid;
    }

    /**
     * @return bool
     */
    public function login(): bool
    {
        AuthSessionHelper::login($this->getUser());
        return true;
    }

    /**
     * @return bool
     */
    public function createNewUser():bool
    {
        return $this->userRepository->createNewUser($this->login,$this->email,$this->password);
    }
}
