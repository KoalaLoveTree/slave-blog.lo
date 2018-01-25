<?php

namespace db;

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

    public function connect()
    {
        try {
            $this->dbh = new \PDO('mysql:host=' . $this->db['server'] . ';dbname=' . $this->db['name'],$this->db['username']);
        } catch (\PDOException $e) {
            die('Error!: ' . $e->getMessage() . '<br/>');
        }
    }

    public function insert(string $tableName, array $args): int
    {

    }

    public function read(string $tableName, string $condition): array
    {
        $stm = $this->dbh->query('SELECT * FROM ' . $tableName .' '. $condition);
        return $result = $stm->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function update(string $tableName, string $condition, array $args)
    {

    }

    public function delete(string $tableName, string $condition)
    {

    }
}
