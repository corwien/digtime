<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">评论数：{{ $article->comments_count }}
            </div>

            <div class="panel-body">
                @include("comments.index")
                @if(Auth::check())
                    @include("shared.errors")
                    <form action="/articles/{{ $article->id }}/comment" method="post">
                        {{ csrf_field() }}
                                <!-- 编辑器容器 -->
                            <div class="form-group">
                                <label for="name">文本框</label>
                                <textarea class="form-control" name="content" rows="5"></textarea>
                            </div>
                        <button class="btn btn-success pull-right" type="submit">提交</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-success  btn-block">登录提交答案</a>
                @endif
            </div>
        </div>
    </div>
</div> 
