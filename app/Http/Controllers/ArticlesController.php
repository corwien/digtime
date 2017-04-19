<?php

namespace App\Http\Controllers;

use App\Markdown\Markdown;
use App\Models\Article;
use Illuminate\Http\Request;
use Auth;

class ArticlesController extends Controller
{

    protected $markdown;

    /**
     * ArticlesController constructor.
     *
     * @param $markdown
     */
    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
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
        $article = Article::findOrFail($id);
        $article->content = $this->markdown->markdown($article->content);
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
