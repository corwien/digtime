<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

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
     * 获取当前登录用户ID
     * @return mixed
     */
    public function auth_id()
    {
        return Auth::id();
    }
}
