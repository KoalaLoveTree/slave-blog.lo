<?php

namespace models\category;

use db\entity\Category;
use models\BaseModel;

class CategoryModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(Category::class);
    }

    public function getCategories():array
    {
        return parent::parse($this->getCategoriesFromDB());
    }

    private function getCategoriesFromDB():array
    {
        return $this->dbManager->read(Category::TABLE_NAME, 'getCategories', []);
    }
}
