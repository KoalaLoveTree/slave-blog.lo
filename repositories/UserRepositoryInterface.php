<?php

namespace repositories;


use db\entity\User;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return \db\entity\Entity|User
     */
    public function findUserById(int $userId): User;

    /**
     * @param string $email
     * @return \db\entity\Entity|User
     */
    public function findUserByEmail(string $email);

    /**
     * @param string $login
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function createNewUser($login, $email, $password): bool;

    /**
     * @return array|null
     */
    public function getAllUsers(): ?array;
}
