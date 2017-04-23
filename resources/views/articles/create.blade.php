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
                                <input type="text" name="title" required="require"
                                       value="{{ old('title') }}" class="form-control" placeholder="标题" id="title">
                            </div>

                            <!-- 编辑器容器 -->

                            <label for="content">内容</label>
                            <div class="form-group">
                                <textarea name="content" class="form-control" rows="20" cols="50"  id="editor">

                                    {{ old('content') }}
                                </textarea>
                            </div>

                            <button class="btn btn-success pull-right" type="submit">发布问题</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>

  @section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var simplemde = new SimpleMDE({
               autofocus: true,
                autosave: {
                    enabled: true,
                    delay: 5000,
                    unique_id: "editor01",
                },
                element: document.getElementById("editor"),
                spellChecker: false,
            });
        });
    </script>
  @endsection
@endsection



