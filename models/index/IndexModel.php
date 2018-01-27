<?php

namespace models\index;

use db\entity\Post;
use models\BaseModel;

class IndexModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getPosts(): array
    {
        $post = new Post();
        return parent::parse($this->getPostsForHome(),get_class($post));
    }

    private function getPostsForHome(): array
    {
        return $this->dbManager->read(Post::TABLE_NAME, 'ORDER BY id DESC LIMIT 3');
    }

}