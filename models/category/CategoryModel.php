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
}
