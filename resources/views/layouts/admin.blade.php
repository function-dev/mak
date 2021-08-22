<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Админская панель</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="admin">
        <div class="sidebar">
            <nav class="sidebar__nav">
                <a href="/" class="sidebar__nav-title">Зазеркалье-МАК</a>
                <a href="{{ route('admin') }}" class="sidebar__nav-item">Пользователи</a>
                <a href="{{ route('roles') }}" class="sidebar__nav-item">Роли</a>
                <a href="{{ route('decks') }}" class="sidebar__nav-item">Колоды</a>
                <a href="{{ route('sessions') }}" class="sidebar__nav-item">Сессии</a>
                <a class="sidebar__nav-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Выйти
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
            </nav>
        </div>

        <div class="admin-content">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
