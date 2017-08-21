<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                        あるWebプログラマの修行日記 Ver.2
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
                @yield('content')
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
