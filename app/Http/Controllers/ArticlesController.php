<?php

namespace App\Http\Controllers;

use App\Markdown\Markdown;
use App\Models\Article;
use Illuminate\Http\Request;
use Auth;
use App\Repositories\ArticleRepository;

// Log 日志
use Illuminate\Support\Facades\Log;

class ArticlesController extends Controller
{

    protected $markdown;

    protected $articleRepository;

    /**
     * ArticlesController constructor.
     *
     * @param $markdown
     */
    public function __construct(ArticleRepository $articleRepository, Markdown $markdown)
    {
        $this->articleRepository = $articleRepository;

        $this->markdown = $markdown;

        // 未登录的用户，某些动作不能操作
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(5);


        foreach($articles as $k => $article)
        {
            $content = $this->markdown->markdown($article->content);

            // 去除html标签
            $content = strCut($content);
            $articles[$k]->content = $content;
        }

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = [
            'title'          => $request->get('title'),
            'category_id'    => 1,
            'slug'           => 'slug' . '-' . time(),
            'subtitle'       => '副标题' . time(),
            'content'        => $request->get('content'),
            'user_id'        => Auth::id(),
        ];
        $article = Article::create($data);

        flash("恭喜你，发布成功！", "success");
        return redirect()->route('articles.show', [$article->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $environment = config('app.locale');
        // dump($environment);

        // 测试Log方法
        // Log::info('show article id' . $id);

        $article = $this->articleRepository->byId($id);
        $article->content = $this->markdown->markdown($article->content);

        // 增加浏览量
        $article->increment('views_count');
        return view('articles.show', compact('article'));
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
