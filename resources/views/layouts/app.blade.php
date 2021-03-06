<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ blog_description() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/highlight.js/9.12.0/styles/solarized-light.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            @if (Session::has('flash_success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach (Session::get('flash_success') as $msg)
                        <p><i class="icon fa fa-check"></i>{{ $msg }}</p>
                    @endforeach
                </div>
            @endif
            @if (Session::has('flash_warning'))
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach (Session::get('flash_warning') as $msg)
                        <p><i class="icon fa fa-warning"></i>{{ $msg }}</p>
                    @endforeach
                </div>
            @endif
            @if (Session::has('flash_error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach (Session::get('flash_error') as $msg)
                        <p><i class="icon fa fa-exclamation-circle"></i>{{ $msg }}</p>
                    @endforeach
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach ($errors->all() as $msg)
                        <p><i class="icon fa fa-exclamation-circle"></i>{{ $msg }}</p>
                    @endforeach
                </div>
            @endif
            <div class="container">
                <div class="navbar-header" style="padding-left: 10px;">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}" style="font-size: 22px;">
                        {{ blog_title() }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">ログイン</a></li>
                            {{--
                            <li><a href="{{ route('register') }}">新規ユーザー作成</a></li>
                            --}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            ログアウト
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ url('auth/admin/index') }}">管理者ページ</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>

        <div class="wrapper content-wrapper">
            <section class="content-header">
                @yield('content_header')
            </section>

            <section class="content">
                <?php $url=route('picture.response', ['name' => '201708211502_sIMG_0035.jpg']); ?>
                <div class="row" style="background-image: url({{$url}});">
                    <div class="col-md-8">
                        @yield('content')
                    </div>
                    <div class="col-md-4">
                        <div class="sidebox" style="margin-top: 22px;">
                            {!! Form::model(null, ['method' => 'GET', 'name' => 'form']) !!}
                            <span style="font-weight: bold;">検索フォーム</span><br>
                            {!! Form::text('words', null, ['placeholder' => '検索ワード']) !!}
                            <input type="submit" value="検索"  class="btn btn-primary">
                            <br>
                            {!! Form::close() !!}
                        </div>

                        <div class="sidebox" style="margin-top: 12px;">
                            <span style="font-weight: bold;">カテゴリー</span><br>
                            <?php $categories = categories(); ?>
                            @forelse($categories as $category)
                            <?php 
                                $url_category = url('/')."?category=".$category->id;
                                $count = \App\Post::where('category_id', $category->id)->count();
                            ?>
                            <a href="{{ $url_category }}">{{ $category->category_name }} ({{$count}})</a><br>
                            @empty
                            <li>まだカテゴリーはありません</li>
                            @endforelse 
                        </div>

                        <div class="sidebox" style="margin-top: 12px;">
                            <span style="font-weight: bold;">最新の投稿</span><br>
                            <?php $sidebar_posts = \App\Post::orderBy('created_at', 'desc')->limit(5)->get(); ?>
                            @forelse($sidebar_posts as $sidebar_post)
                            &nbsp;* <a href="{{ action('PostsController@show', $sidebar_post->id) }}">{{ $sidebar_post->title }}</a><br>
                            @empty
                            <li>まだ投稿はありません</li>
                            @endforelse 
                        </div>

                        <div class="sidebox" style="margin-top: 12px;">
                            <span style="font-weight: bold;">最新のコメント</span><br>
                            <?php $sidebar_comments = \App\Comment::orderBy('created_at', 'desc')->limit(5)->get(); ?>
                            @forelse($sidebar_comments as $sidebar_comment)
                            &nbsp;* <a href="{{ action('PostsController@show', $sidebar_comment->post->id) }}">{{ $sidebar_comment->post->title }}</a><br>
                            @empty
                            <li>まだコメントはありません</li>
                            @endforelse 
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/underscore.js/1.8.3/underscore-min.js') }}"></script>
    <script src="{{ asset('js/highlight.js/9.12.0/highlight.min.js') }}"></script>
    <script src="{{ asset('js/marked/0.3.6/marked.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    @yield('script')
</body>
</html>

