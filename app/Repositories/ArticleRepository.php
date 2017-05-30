<?php

namespace App\Repositories;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

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
        // Eager Loading  渴望加载 N+1 的问题【20170525】
        // https://laravel.com/docs/5.4/eloquent-relationships
        // $article = Article::find($id);

        // 这里只获取父类的评论
       $article = Article::with(['comments' => function($query){
        $query->where('parent_id', 0);
    }, 'comments.user'])
            ->where('id', $id)
            ->first();

        // 评论列表
        $comments = $article->comments;

        // 获取子回复
        if($comments)
        {
            foreach($comments as $k => $comment)
            {


                // https://docs.golaravel.com/docs/5.0/queries/
                // select * from users where name = 'John' or (votes > 100 and title <> 'Admin')
                /*
                $ret = DB::select("select * from comments WHERE commentable_id = {$id}
                           AND (parent_id = {$comment_id} OR group_id = {$comment_id})
                           ORDER BY created_at ASC limit 0,100 ");
                */

                // 获取对应的子回复
                $comment_id = $comment->id;

                // 这里只获取父类的评论,闭包函数中传入外部的变量时，需要使用use 方法
                // Example http://www.jb51.net/article/79350.htm
                $sub_article = Article::with(['comments' => function($query) use ($comment_id) {
                    $query->where('group_id', $comment_id);
                }, 'comments.user'])
                    ->where('id', $id)
                    ->first();

                $comment->sub_comments = empty($sub_article->comments) ? array() : $sub_article->comments;
                $comments[$k] = $comment;
            }
        }

       return $comments;
    }

}
