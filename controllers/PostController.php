<?php

namespace controllers;


use models\post\PostModel;

class PostController extends Controller
{
    public function showAction(string $name, string $id)
    {
        $post = new PostModel();
        $result = $post->getPost((int)$id);
        $category = $post->getCategoryTitle((int)$result[0]->getCategoryId());
        $author = $post->getAuthorName((int)$result[0]->getAuthorId());
        return $this->getView()->render('post',[
            'category' => $category,
            'author' => $author,
            'title' => $result[0]->getTitle(),
            'content' => $result[0]->getContent(),
            'pubdate' => $result[0]->getPubdate(),
        ]);
    }
}
