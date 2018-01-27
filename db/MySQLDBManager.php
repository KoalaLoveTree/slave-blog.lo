<?php

namespace db;

use db\entity\Category;
use db\entity\Post;
use db\entity\User;

class MySQLDBManager implements DB
{
    /** @var array* */
    private $db;
    /** @var \PDO* */
    private $dbh;

    public function __construct(array $db)
    {
        $this->db = $db;
        $this->connect();
    }

    public function connect():void
    {
        try {
            $this->dbh = new \PDO('mysql:host=' . $this->db['server'] . ';dbname=' . $this->db['name'], $this->db['username']);
        } catch (\PDOException $e) {
            die('Error!: ' . $e->getMessage() . '<br/>');
        }
    }

    public function insert(string $tableName, array $args): bool
    {
        if ($tableName == User::TABLE_NAME) {
            $stmu = $this->dbh->prepare('INSERT INTO user (login, password, email) VALUES '
                . '(:login, :password, :email)');
            $stmu->bindParam(':login', $args['login']);
            $stmu->bindParam(':password', $args['password']);
            $stmu->bindParam(':email', $args['email']);
            return $stmu->execute();
        }
        return false;
    }

    public function read(string $tableName, string $target, array $args): ?array
    {
        if ($tableName == User::TABLE_NAME && $target == 'authorization') {
            $stmu = $this->dbh->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
            $stmu->execute(array($_POST['email'], $_POST['password']));
            if ($stmu != null) {
                return $result = $stmu->fetchAll(\PDO::FETCH_ASSOC);
            }
            return null;
        }
        if ($tableName == User::TABLE_NAME && $target == 'emailExist') {
            $stmu = $this->dbh->prepare('SELECT * FROM user WHERE email = ?');
            $stmu->execute(array($_POST['email']));
            if ($stmu != null) {
                return ['answer' => 'email is exist'];
            }
            return null;
        }
        if ($tableName == Post::TABLE_NAME && $target == 'postsForHome') {
            $stmu = $this->dbh->prepare('SELECT * FROM post ORDER BY id DESC LIMIT 3');
            $stmu->execute();
            if ($stmu != null) {
                return $result = $stmu->fetchAll(\PDO::FETCH_ASSOC);
            }
            return null;
        }
        if ($tableName == Post::TABLE_NAME && $target == 'chosenPost') {
            $stmu = $this->dbh->prepare('SELECT * FROM post WHERE id = ?');
            $stmu->execute(array($args[0]));
            if ($stmu != null) {
                return $result = $stmu->fetchAll(\PDO::FETCH_ASSOC);
            }
            return null;
        }
        if ($tableName == User::TABLE_NAME && $target == 'authorNameForPost') {
            $stmu = $this->dbh->prepare('SELECT login FROM user WHERE id = ?');
            $stmu->execute(array($args[0]));
            if ($stmu != null) {
                return $result = $stmu->fetchAll(\PDO::FETCH_ASSOC);
            }
            return null;
        }
        if ($tableName == Category::TABLE_NAME && $target == 'categoryTitleForPost') {
            $stmu = $this->dbh->prepare('SELECT title FROM category WHERE id = ?');
            $stmu->execute(array($args[0]));
            if ($stmu != null) {
                return $result = $stmu->fetchAll(\PDO::FETCH_ASSOC);
            }
            return null;
        }
        if ($tableName == Category::TABLE_NAME && $target == 'getCategories') {
            $stmu = $this->dbh->prepare('SELECT * FROM category');
            $stmu->execute();
            if ($stmu != null) {
                return $result = $stmu->fetchAll(\PDO::FETCH_ASSOC);
            }
            return null;
        }
        return null;
    }

    public function update(string $tableName, string $condition, array $args)
    {

    }

    public function delete(string $tableName, string $condition)
    {

    }
}
