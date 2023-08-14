<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <div class="topPanel topPanelText">
        <ul>
            <li>
                <img id="imageSize" src="{{asset('build/assets/rose-073a4941.png')}}">
            </li>

            <li>
                <a href="{{route('home')}}">
                    <button id="logo">"Алая Роза" артклуб</button>
                </a>
            </li>

            @auth('web')
            <li onmouseenter="window.view()" onmouseleave="window.hidden()">
                <button class="mini" >{{Auth::user()->login}}
                    <div class="hidden" id="pop">
                        <a href="{{route('personalArea')}}">Личный кабинет</a>
                        <a href="{{route('news')}}">Новости</a>
                        <a href="{{route('posters')}}">Афиша</a>
                        <a href="{{route('home')}}">Галерея</a>
                        <a href="{{route('logout')}}">Выйти</a>
                    </div>
                </button>
            </li>

            <li onmouseenter="window.view()" onmouseleave="window.hidden()">
                <div class="circle"></div>
            </li>
            @endauth

            @guest('web')
            <li>
                <a class="mini" href="{{ route('login') }}">
                    <button class="mini">Войти</button>
                </a>
            </li>
            @endguest
        </ul>
    </div>



    @yield('content')
</body>
</html>
