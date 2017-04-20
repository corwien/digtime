@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发布问题</div>

                    <div class="panel-body">
                        @include("shared.errors")
                        <form action="/articles" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">标题</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="标题" id="title">
                            </div>

                            <!-- 编辑器容器 -->
                            <div class="form-group">
                                <label for="content">内容</label>
                                <textarea class="form-control" name="content" placeholder="内容">
                                     {{ old('content') }}
                                </textarea>
                            </div>
                            <button class="btn btn-success pull-right" type="submit">发布问题</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>

@endsection



