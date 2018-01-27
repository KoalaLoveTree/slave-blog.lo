<?php

namespace models\index;

use db\entity\Post;
use models\BaseModel;

class IndexModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct(Post::class);
    }

    public function getPosts(): array
    {
        return parent::parse($this->getPostsForHome());
    }

    private function getPostsForHome(): array
    {
        return $this->dbManager->read(Post::TABLE_NAME, 'postsForHome');
    }

}