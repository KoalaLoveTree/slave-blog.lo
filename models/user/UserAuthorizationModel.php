<?php
/**
 * Created by PhpStorm.
 * User: AgyKoala
 * Date: 27.01.2018
 * Time: 8:35
 */

namespace models\User;


use db\entity\User;
use models\BaseModel;

class UserAuthorizationModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function validate(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function addNewUser(): ?int
    {
        if ($this->isEmailExist()) {
            return null;
        } else {
            return $this->dbManager->insert(User::TABLE_NAME, ['login' => $_POST['login'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
            ]);
        }
    }

    public function checkPassword(): int
    {
        if ($this->isUserExist()) {
            return 1;
        }
        return 0;
    }

    private function isUserExist(): bool
    {
        if ($this->dbManager->read(User::TABLE_NAME, 'authorization',[])){
            return true;
        }
        return false;
    }

    private function isEmailExist(): bool
    {
        if ($this->dbManager->read(User::TABLE_NAME, 'emailExist',[])) {
            return true;
        }
        return false;
    }
}
