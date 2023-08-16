<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('imagesAsset/roseIcon.png')}}">
    @vite('resources/css/app.css')
</head>
<body>
    <ul class="topPanel">
        <li><img src="{{asset('imagesAsset/rose.png')}}"></li>
        <li class="textWhite logo"><a href="{{route('home')}}">Арт клуб "Алая роза" </a></li>
        <li class="textWhite header"><a>@yield('title')</a></li>

        @auth('web')
        <li class="last textWhite" onmouseenter="window.view()" onmouseleave="window.hidden()">
            <a>
                {{Auth::user()->login}}
            </a>
            <div class="hidden textWhite" id="pop">
                <a href="{{route('personalArea')}}">Личный кабинет</a>
                <hr>
                <a href="{{route('news')}}">Новости</a>
                <a href="{{route('posters')}}">Афиши</a>
                <a href="{{route('home')}}">Галерея</a>
                <a></a>
                <a href="{{route('logout')}}">Выйти</a>
            </div>
        </li>

        <li class="last circle" onmouseenter="window.view()" onmouseleave="window.hidden()">
            <div></div>
        </li>
        @endauth

        @guest('web')
        <li class="last textWhite">
            <a href="{{ route('login') }}">
                Войти
            </a>
        </li>
        @endguest
    </ul>

    @yield('content')
</body>
</html>
