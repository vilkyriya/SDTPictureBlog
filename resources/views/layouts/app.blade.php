<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @guest
                <a class="navbar-brand" href="{{ url('/') }}">
                    Главная
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @endguest

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Auth::user()->isUser())
                                <a class="nav-link" href="{{ url('/') }}">Все изображения</a>
                            @elseif(Auth::user()->isAdministrator())
                                <a class="nav-link" href="{{ url('/') }}">Все изображения</a>
                                <a class="nav-link" href="{{ url('/admin/index') }}">Панель адинистратора</a>
                            @endif

                            <a class="nav-link" href="{{ url('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Выйти
                            </a>

                            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
