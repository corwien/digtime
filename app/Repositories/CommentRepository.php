<?php

namespace App\Repositories;
use App\Models\Comment;

/**
 * Class CommentRepository
 *
 * @package \App\Repositories
 */
class CommentRepository
{
    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Comment::create($attributes);
    }

    public function byId($comment_id)
    {
        return Comment::find($comment_id);
    }



}
