<?php

namespace repositories;


use db\entity\Comment;

class CommentRepository extends BaseDbRepository
{

    public function getEntityClassName(): string
    {
        return Comment::class;
    }
}