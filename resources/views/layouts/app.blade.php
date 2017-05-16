<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Laravel')  - Digtime 博客</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};

        Laravel.apiToken = "{{ Auth::check() ? 'Bearer '.Auth::user()->api_token : 'Bearer ' }}";
    </script>
</head>
<body>
    <div id="app">
        @include('layouts._header')
        @include('shared.messages')
        @yield('content')
        @include('layouts._footer')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- 广播通知
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
     -->

    <!-- 实例化MD编辑器 -->
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

    <!-- Scripts  代码高亮初始化加载 -->
    <script>
        hljs.initHighlightingOnLoad();
    </script>

    <!-- 在项目中引入其他js,如simplemd时，必须将编辑器引用写在js区域内，否则会找不到对象 -->
    @yield('js')


</body>
</html>
