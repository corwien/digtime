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

    /**
     * 获取作品评论
     * @param $id
     *
     * @return mixed
     */
    public function getArticleCommentsById($id)
    {
        // $article = Article::find($id);
       $article = Article::with('comments', 'comments.user')
          ->where('id', $id)->first();
        return $article->comments;

    }

}
