<?php

namespace repositories;


use core\App;
use db\entity\Entity;
use core\DBPropertyNotFoundException;

abstract class BaseDbRepository
{
    /** @var \PDO */
    protected $dbConnection;

    /**
     * BaseDbRepository constructor.
     */
    public function __construct()
    {
        $this->dbConnection = App::getDbm()->getDB();
    }

    /**
     * @return string
     */
    abstract public function getEntityClassName(): string;

    /**
     * @param array $data
     * @return array
     * @throws DBPropertyNotFoundException
     */
    protected function populateEntity(array $data): array
    {
        $result = [];
        foreach ($data as $item) {
            $cn = $this->getEntityClassName();
            $entity = new $cn;
            $result[] = $this->arrayToEntity($item, $entity);
        }
        return $result;
    }

    /**
     * @param array $data
     * @param Entity $entity
     * @return Entity
     * @throws DBPropertyNotFoundException
     */
    protected function arrayToEntity(array $data, Entity $entity): Entity
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
