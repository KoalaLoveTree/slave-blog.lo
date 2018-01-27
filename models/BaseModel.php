<?php

namespace models;

use core\App;
use core\DBPropertyNotFoundException;
use db\entity\Entity;

abstract class BaseModel
{
    /**@var DB */
    protected $dbManager;
    private $entityName;

    public function __construct(string $entityName)
    {
        $this->dbManager = App::getDbm();
        $this->entityName = $entityName;
    }

    public function parse(array $param): array
    {
        $result = [];
        foreach ($param as $item) {
            $entity = new $this->entityName;
            $result[] = $this->parseSecondary($item, $entity);
        }
        return $result;
    }

    public function parseSecondary(array $data, Entity $entity):Entity
    {
        foreach ($data as $key => $value) {
            $setFunc = 'set' . ucfirst($key);
            if (!method_exists($entity, $setFunc)) {
                throw new DBPropertyNotFoundException('Method ' . $setFunc . ' does not exist');
            }
            call_user_func_array([$entity, $setFunc], [$value]);
        }
        return $entity;
    }

}
