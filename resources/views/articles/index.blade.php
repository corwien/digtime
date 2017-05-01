@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($articles as $article)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img width="60px" class="avatar" src="{{ $article->user->avatar }}" alt="{{ $article->user->name }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="/articles/{{ $article->id }}">{{ $article->title }}</a>
                            </h4>
                            <p>
                                {{ $article->content }}
                            </p>
                        </div>
                    </div>
                @endforeach

                    {!! $articles->render() !!}
            </div>
        </div>
    </div>
@endsection