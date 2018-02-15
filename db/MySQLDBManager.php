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

    protected function connect(): void
    {
        try {
            $this->dbh = new \PDO('mysql:host=' . $this->db['server'] . ';dbname='
                . $this->db['name'], $this->db['username']);
        } catch (\PDOException $e) {
            die('Error!: ' . $e->getMessage() . '<br/>');
        }
    }

    public function getDB(): \PDO
    {
        return $this->dbh;
    }
}
