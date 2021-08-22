<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="150x150" href="/mstile-150x150.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Зазеркалье-МАК</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="header">
            <div class="container">
                <div class="header-body">
                    <a href="{{ route('home') }}" class="header-title"><img src="/img/logo.svg" alt="Зазеркалье" class="logo"></a>
                    <nav class="nav">
                        @guest
                            <a class="nav__link" href="{{ route('login') }}">Войти</a>
                            <a class="nav__link" href="{{ route('register') }}">Регистрация</a>
                        @else
                            <a class="nav__link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Выйти
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                @csrf
                            </form>
                        @endguest
                    </nav>
                </div>
            </div>
        </header>

        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
