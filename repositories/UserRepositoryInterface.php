<?php

namespace repositories;


use core\DBPropertyNotFoundException;
use db\entity\Entity;

interface UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return Entity|null
     * @throws DBPropertyNotFoundException
     */
    public function findUserById(int $userId): ?Entity;

    /**
     * @param string $email
     * @return Entity|null
     * @throws DBPropertyNotFoundException
     */
    public function findUserByEmail(string $email): ?Entity;

    /**
     * @param string $login
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function createNewUser($login, $email, $password): bool;

    /**
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getAllUsers(): ?array;
}
