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
    <ul>
        <li><img src="{{asset('build/assets/rose-073a4941.png')}}"></li>
        <li class="logo"><a href="{{route('home')}}">Арт клуб "Алая роза" </a></li>
        <li class="header"><a>@yield('title')</a></li>

        @auth('web')
        <li class="last" onmouseenter="window.view()" onmouseleave="window.hidden()">
            <a>
                {{Auth::user()->login}}
            </a>
                <div class="hidden buttonHidenBlock" id="pop">
                    <a href="{{route('personalArea')}}">Личный кабинет</a>
                    <hr>
                    <a href="{{route('news')}}">Новости</a>
                    <a href="{{route('posters')}}">Афиша</a>
                    <a href="{{route('home')}}">Галерея</a>
                    <a></a>
                    <a class="buttonHidenBlock" href="{{route('logout')}}">Выйти</a>
                </div>
        </li>

        <li class="last circle" onmouseenter="window.view()" onmouseleave="window.hidden()">
            <div></div>
        </li>
        @endauth

        @guest('web')
        <li class="last">
            <a href="{{ route('login') }}">
                Войти
            </a>
        </li>
        @endguest
    </ul>


    <!--<div class="topPanel topPanelText">
        <ul>


            <li>
                <img id="imageSize" src="{{asset('build/assets/rose-073a4941.png')}}">
            </li>

            <li>
                <a href="{{route('home')}}">"Алая Роза" артклуб</a>
            </li>

            <li>
                <div class="header">
                    <h1 class="header">@yield('title')</h1>
                </div>
            </li>



            @auth('web')
            <li onmouseenter="window.view()" onmouseleave="window.hidden()">
                <button class="mini" >{{Auth::user()->login}}
                    <div class="hidden buttonHidenBlock" id="pop">
                        <a href="{{route('personalArea')}}">Личный кабинет</a>
                        <hr>
                        <a href="{{route('news')}}">Новости</a>
                        <a href="{{route('posters')}}">Афиша</a>
                        <a href="{{route('home')}}">Галерея</a>
                        <a class="buttonHidenBlock" href="{{route('logout')}}">Выйти</a>
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
    </div>-->



    @yield('content')
</body>
</html>
