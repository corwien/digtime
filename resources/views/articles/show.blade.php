@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $article->title }}

                    </div>

                    <div class="panel-body content">
                        {!! $article->content !!}
                    </div>
                </div>
            </div>
        </div>
@endsection



