<?php

namespace db;

class DBManager implements DB
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

    public function connect()
    {
        try {
            $this->dbh = new \PDO('mysql:host=' . $this->db['server'] . ';dbname=' . $this->db['name'],
                $this->db['username'], $this->db['password']);
        } catch (\PDOException $e) {
            die('Error!: ' . $e->getMessage() . '<br/>');
        }
    }

    public function insert(string $tableName, array $args): int
    {

    }
    public function read(string $tableName, int $id): array
    {

    }

    public function update(string $tableName, int $id, array $args)
    {

    }

    public function delete(string $tableName, int $id)
    {

    }
}
