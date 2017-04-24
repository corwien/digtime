<?php

namespace App\Repositories;
use App\Models\Article;

/**
 * Class ArticleRepository
 *
 * @package \App\Repositories
 */
class ArticleRepository
{
    /**
     * 获取作品
     * @param $id
     *
     * @return mixed
     */
    public function byId($id)
    {
        return Article::findOrFail($id);
    }

    public function foo(){

    }

}
