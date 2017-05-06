<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use Auth;

class CommentsController extends Controller
{
    protected $commentRepository;

    /**
     * CommentsController constructor.
     *
     * @param $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        // 未登录的用户，某些动作不能操作
        $this->middleware('auth')->except(['index', 'show']);

        $this->commentRepository = $commentRepository;
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
    public function store(StoreCommentRequest $request, $article)
    {
        // 这里默认暂时写死先
        $model = $this->getModelNameFromType($type = "article");

        $data = [
            'commentable_type' => $model,   // 多态模式
            'commentable_id'   => $article, // 多态ID
             'content'         => $request->get('content'),
            'user_id'          => Auth::id(),
        ];
        $comment = $this->commentRepository->create($data);

        // 增加评论数
        $comment->article()->increment('comments_count');

        flash("恭喜你，评论成功！", "success");
        return back();

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
