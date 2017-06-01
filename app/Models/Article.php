<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'category_id',
        'slug',
        'subtitle',
        'published_at',
        'views_count',
        'comments_count',
    ];

    /**
     * 和用户关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * 获取所有问题的评论
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    /**
     * 修改时间属性
     * @param $date
     *
     * @return mixed
     * @demo https://www.laravist.com/blog/post/use-carbon-to-format-datetime-in-laravel-project
     */
    public function getCreatedAtAttribute($date)
    {
        if(Carbon::now() > Carbon::parse($date)->addDays(100))
        {
            return Carbon::parse($date);
        }

        return Carbon::parse($date)->diffForHumans();
    }
}
