<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
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
            <li>
                <a class="mini" href="{{route('createCard')}}">
                    <button>{{Auth::user()->login}}</button>
                </a>
            </li>

            <li>
                <a href="{{route('createCard')}}">
                    <div class="circle"></div>
                </a>
            </li>
            @endauth

            @guest('web')
            <li class="mini">
                <a href="{{ route('login') }}">
                    <button>Войти</button>
                </a>
            </li>
            @endguest
        </ul>
    </div>

    @yield('content')
</body>
</html>
