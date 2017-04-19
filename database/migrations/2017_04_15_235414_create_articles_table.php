<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();  // 分类ID
            $table->integer('user_id')->unsigned();
            $table->string('slug')->unique();   // 缩略名
            $table->string('title');
            $table->string('subtitle');
            $table->text('content');
            $table->string('source')->nullable()->index(); // 来源关注：iOS，Android
            $table->string('page_image')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_original')->default(false);   // 是否原创
            $table->boolean('is_draft')->default(false);      // 是否草稿
            $table->integer('views_count')->unsigned()->default(0)->index();   // 浏览数
            $table->integer('comments_count')->unsigned()->default(0)->index();   // 评论数
            $table->integer('order')->default(0)->index();   // 排序
            $table->integer('votes_count')->default(0)->index();  // 点赞数
            $table->enum('is_excellent', ['T', 'F'])->default('F')->index();      // 是否精华作品
            $table->enum('is_blocked', ['T', 'F'])->default('F')->index();        // 是否屏蔽
            $table->integer('last_comment_user_id')->unsigned()->default(0)->index();    // 最后一个回复者ID
            $table->timestamp('published_at')->nullable();   // 正式发布作品时间
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
