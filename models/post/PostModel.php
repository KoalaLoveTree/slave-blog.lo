<?php

namespace models\post;

use db\entity\Category;
use db\entity\Post;
use db\entity\User;
use models\BaseModel;

class PostModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(Post::class);
    }

    public function getPost(int $id): array
    {
        return parent::parse($this->getPostContent($id));
    }

    public function getAuthorName(int $id):string
    {
        $result = $this->getAuthorNameById($id);
        return $result[0]['login'];
    }

    public function getCategoryTitle(int $id):string
    {
        $result = $this->getCategoryTitleById($id);
        return $result[0]['title'];
    }

    private function getPostContent(int $id): array
    {
        return $this->dbManager->read(Post::TABLE_NAME, 'chosenPost', ['0' => $id,]);
    }

    private function getAuthorNameById(int $id): array
    {
        return $this->dbManager->read(User::TABLE_NAME, 'authorNameForPost', ['0' => $id,]);
    }

    private function getCategoryTitleById(int $id): array
    {
        return $this->dbManager->read(Category::TABLE_NAME, 'categoryTitleForPost', ['0' => $id,]);
    }
}
