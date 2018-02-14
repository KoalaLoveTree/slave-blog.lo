<?php
/**
 * Created by PhpStorm.
 * User: AgyKoala
 * Date: 14.02.2018
 * Time: 3:06
 */

namespace repositories;


interface CategoryRepositoryInterface
{
    /**
     * @param int $id
     * @return Category|\db\entity\Entity
     * @throws \core\DBPropertyNotFoundException
     */
    public function getCategoryById(int $id):Category;

    /**
     * @return array
     */
    public function getAllCategories():array;
}