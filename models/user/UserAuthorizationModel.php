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
        if ($this->isUserExist() != null) {
            return null;
        } else {
            return $this->dbManager->insert(User::TABLE_NAME, ['login' => $_POST['login'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                ]);
        }
    }

    public function checkPassword():int
    {
        $result = $this->isUserExist();
        if ($result != null) {
            $user = parent::parse($result);
            if ($user[0]->getPassword() == $_POST['password']) {
                return 0;
            } else {
                return 2;
            }
        }
        return 1;
    }

    public function isUserExist(): ?array
    {
        return $this->dbManager->read(User::TABLE_NAME, 'authorization');
    }
}