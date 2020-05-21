<?php

namespace repositories;


use core\DBPropertyNotFoundException;
use db\entity\Category;
use db\entity\Entity;

class CategoryRepository extends BaseDbRepository implements CategoryRepositoryInterface
{
    /**
     * @param int $id
     * @return Entity|null
     * @throws DBPropertyNotFoundException
     */
    public function getCategoryById(int $id): ?Entity
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Category::TABLE_NAME . ' WHERE id = ?');
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $category = new Category();
        return $this->arrayToEntity($result[0], $category);
    }

    /**
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getAllCategories(): ?array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM ' . Category::TABLE_NAME);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    /**
     * @return string
     */
    public function getEntityClassName(): string
    {
        return Category::class;
    }
}
