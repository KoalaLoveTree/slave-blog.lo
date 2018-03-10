<?php

namespace repositories;


use core\DBPropertyNotFoundException;
use db\entity\Entity;

interface CategoryRepositoryInterface
{
    /**
     * @param int $id
     * @return Entity|null
     * @throws DBPropertyNotFoundException
     */
    public function getCategoryById(int $id): ?Entity;

    /**
     * @return array|null
     * @throws DBPropertyNotFoundException
     */
    public function getAllCategories(): ?array;
}