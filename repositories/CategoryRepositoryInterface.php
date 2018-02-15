<?php

namespace repositories;


use db\entity\Category;

interface CategoryRepositoryInterface
{
    /**
     * @param int $id
     * @return Category
     */
    public function getCategoryById(int $id): Category;

    /**
     * @return array
     */
    public function getAllCategories(): array;
}