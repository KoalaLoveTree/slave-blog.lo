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

    public function checkPassword(string $enterPassword, User $user): bool
    {
        if (password_verify($enterPassword,$user->getPassword())){
            return true;
        }
        return false;
    }

}
