<?php

namespace db;

use PDO;

class MySQLDBManager implements DB
{
    /** @var array* */
    private $db;
    /** @var PDO* */
    private $dbh;

    /**
     * MySQLDBManager constructor.
     * @param array $db
     */
    public function __construct(array $db)
    {
        $this->db = $db;
        $this->connect();
    }

    protected function connect(): void
    {
        try {
            $this->dbh = new PDO('mysql:host=' . $this->db['server'] . ';dbname='
                . $this->db['name'], $this->db['username']);
        } catch (\PDOException $e) {
            die('Error!: ' . $e->getMessage() . '<br/>');
        }
    }

    /**
     * @return PDO
     */
    public function getDB(): PDO
    {
        return $this->dbh;
    }
}
