<?php

namespace models\index;

use core\App;
use db\MySQLDBManager;


class IndexModel
{

    const TABLE_NAME = 'post';

    /** @var MySQLDBManager */
    protected $dbManager;

    public function __construct()
    {
        $this->dbManager = App::getDbm();
    }

    public function getPostsForHome() : array
    {
        return $this->dbManager->read(self::TABLE_NAME, 'ORDER BY id DESC LIMIT 3');
    }

}