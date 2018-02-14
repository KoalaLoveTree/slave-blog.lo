<?php

namespace repositories;


use db\entity\Category;

class CategoryRepository extends BaseDbRepository
{
    /**
     * @param int $id
     * @return Category|\db\entity\Entity
     * @throws \core\DBPropertyNotFoundException
     */
    public function getCategoryById(int $id):Category
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM category WHERE id = ?');
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $category = new Category();
        return $this->arrayToEntity($result[0], $category);
    }

    /**
     * @return array
     */
    public function getAllCategories():array
    {
        $stmt = $this->dbConnection->prepare('SELECT * FROM category');
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->populateEntity($result);
    }

    public function getEntityClassName(): string
    {
        return Category::class;
    }
}
