<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use Auth;


class CommentsController extends Controller
{
    protected $commentRepository;

    protected $article;

    /**
     * CommentsController constructor.
     *
     * @param $commentRepository
     */
    public function __construct(CommentRepository $commentRepository, ArticleRepository $article)
    {
        // 未登录的用户，某些动作不能操作
        // $this->middleware('auth')->except(['index', 'show', 'article']);

        $this->commentRepository = $commentRepository;
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * 获取作品评论
     * @param $id
     *
     * @return mixed
     */
    public function article($id)
    {
        return $this->article->getArticleCommentsById($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // 这里默认暂时写死先
        $type = $this->getModelNameFromType(request('type'));

        // dd(request('comment_id'));
        // 判断是否回复
        $content = request('reply_content') ? request('reply_content') : request('content');
        $data = [
            'commentable_type' => $type,   // 多态模式
            'commentable_id'   => request('model'), // 多态ID
            'content'          => $content,
            'parent_id'        => (int)request('comment_id'),
            'user_id'          => Auth::guard('api')->user()->id,
        ];
        $comment = $this->commentRepository->create($data);

        // 增加评论数
        $comment->article()->increment('comments_count');

        $user_obj = $comment->user;
        $comment->user = $user_obj;

        return $comment;
        // flash("恭喜你，评论成功！", "success");
        // return back();

    }

    public function getModelNameFromType($type)
    {
        return $type === 'article' ? 'App\Models\Article' : 'App\Models\Profile';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
