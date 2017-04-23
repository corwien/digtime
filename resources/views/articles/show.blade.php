@extends('layouts.app')

@section('content')
        <div class="blog-pages">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel article-body content-body">
                    <div class="panel-body">
                        <h1 class="text-center">
                            {{ $article->title }}
                        </h1>

                        <div class="article-meta text-center">
                            <i class="fa fa-clock-o"></i> <abbr title="{{ $article->created_at }}" class="timeago">{{ $article->created_at }}</abbr>
                            ⋅
                            <i class="fa fa-eye"></i> {{ $article->views_count }}
                            ⋅
                            <i class="fa fa-thumbs-o-up"></i> {{ $article->votes_count }}
                            ⋅
                            <i class="fa fa-comments-o"></i> {{ $article->comments_count }}

                        </div>

                        <div class="entry-content">
                            <div class="markdown" id="emojify">
                                {!! $article->content !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection



