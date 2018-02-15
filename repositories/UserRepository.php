<?php

namespace repositories;

use db\entity\User;

class UserRepository extends BaseDbRepository implements UserRepositoryInterface
{
    /**
     * @param int $userId
     * @return \db\entity\Entity|User
     * @throws \core\DBPropertyNotFoundException
     */
    public function findUserById(int $userId): User
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->execute(array($userId));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $user = new User();
        return $this->arrayToEntity($result[0], $user);
    }

    /**
     * @param string $email
     * @return \db\entity\Entity|User
     * @throws \core\DBPropertyNotFoundException
     */
    public function findUserByEmail(string $email)
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM user WHERE email = ?');
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
            'INSERT INTO user (login, password, email) VALUES (:login, :password, :email)');
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    public function getEntityClassName(): string
    {
        return User::class;
    }
}