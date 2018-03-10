<?php

namespace repositories;

use core\DBPropertyNotFoundException;
use db\entity\Entity;
use db\entity\User;

class UserRepository extends BaseDbRepository implements UserRepositoryInterface
{

    /**
     * @param int $userId
     * @return Entity|null
     * @throws DBPropertyNotFoundException
     */
    public function findUserById(int $userId): ?Entity
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . User::TABLE_NAME . ' WHERE id = ?');
        $stmt->execute(array($userId));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $user = new User();
        return $this->arrayToEntity($result[0], $user);
    }

    /**
     * @param string $email
     * @return Entity|null
     * @throws DBPropertyNotFoundException
     */
    public function findUserByEmail(string $email): ?Entity
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . User::TABLE_NAME . ' WHERE email = ?');
        $stmt->execute(array($email));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $user = new User();

        $data = $result[0] ?? null;

        if (!$data) {
            return null;
        }

        return $this->arrayToEntity($data, $user);
    }

    /**
     * @param string $login
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function createNewUser($login, $email, $password): bool
    {
        $stmt = $this->dbConnection->prepare(
            'INSERT INTO ' . User::TABLE_NAME . ' (login, password, email) VALUES (:login, :password, :email)');
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    /**
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getAllUsers(): ?array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . User::TABLE_NAME);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);

    }

    /**
     * @return string
     */
    public function getEntityClassName(): string
    {
        return User::class;
    }
}
