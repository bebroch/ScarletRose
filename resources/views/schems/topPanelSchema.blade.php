<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('imagesAsset/roseIcon.png') }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<!-- Цвета заднего фона #405b48 #3CB371 -->

<body>
    <nav class="navbar navbar-dark" style="background-color: #405b48;"> <!-- Заменен bg-dark на bg-success -->
        <div class="container">
            <!-- Главное меню -->

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('imagesAsset/logo.png') }}" height="75px" class="d-inline-block align-text-top">
            </a>

            @guest('web')
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel">
                    <!-- Имя пользователя -->
                    <div class="offcanvas-header" style="background-color: #405b48;">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li>
                                <a class="nav-link" style="font-size: 25px"
                                    href="{{ route('login') }}">{{ __('Вход') }}</a>
                            </li>
                            <li>
                                <a class="nav-link" style="font-size: 25px"
                                    href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                            </li>
                    </div>
                    <!-- End Имя пользователя -->
                    <!-- Пункты меню -->
                    <div class="offcanvas-body" style="background-color: #405b48;">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <!-- Галерея -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('pictures') }}"
                                    style="font-size: 20px;">Галерея</a>
                            </li>
                            <!-- Новости -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('news') }}"
                                    style="font-size: 20px;">Новости</a>
                            </li>
                            <!-- Афиша -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('posters') }}"
                                    style="font-size: 20px;">Афиша</a>
                            </li>
                            <!-- Выставки -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('exhibitions') }}"
                                    style="font-size: 20px;">Выставка</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endguest
            <!-- End Главное меню -->
            @auth('web')
                <!-- Кнопка справа -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- End Кнопка справа -->
                <!-- Меню справа -->
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel">
                    <!-- Имя пользователя -->
                    <div class="offcanvas-header" style="background-color: #405b48;">
                        <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><a class="nav-link" href="{{ route('profile') }}">{{ Auth::user()->login }}</a></h3>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <!-- End Имя пользователя -->
                    <!-- Пункты меню -->
                    <div class="offcanvas-body" style="background-color: #405b48;">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <!-- Галерея -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('pictures') }}"
                                    style="font-size: 20px;">Галерея</a>
                            </li>
                            <!-- Новости -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('news') }}"
                                    style="font-size: 20px;">Новости</a>
                            </li>
                            <!-- Афиша -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('posters') }}"
                                    style="font-size: 20px;">Афиша</a>
                            </li>
                            <!-- Выставки -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('exhibitions') }}"
                                    style="font-size: 20px;">Выставка</a>
                            </li>
                            <!-- Личный кабинет -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" style="font-size: 20px;"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Личный кабинет
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="{{ route('myPictures') }}">Мои картины</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('createPicture') }}">Добавить
                                            картину</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('profile') }}">Обо мне</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('updateInfo') }}">Изменить
                                            информацию</a></li>
                                </ul>
                            </li>

                            <!-- Админ Панель -->
                            @if (Auth::user()->is_admin)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" role="button" style="font-size: 20px;"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Админ панель
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('createNews') }}">Добавить
                                                новость</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('createPoster') }}">Добавить
                                                афишу</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('createExhibition') }}">Добавить
                                                выставку</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('moderationPictures') }}">
                                                Картины на проверке
                                                @if (DB::table('pictures')->where('status', '=', 0)->count())
                                                    <span
                                                        class="badge bg-primary rounded-pill">{{ DB::table('pictures')->where('status', '=', 0)->count() }}</span>
                                                @endif

                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('adminUsers') }}">
                                                Пользователи
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ DB::table('users')->count() }}</span>
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('categories') }}">Категории</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            <!-- Отступ -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page"></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page"></a>
                            </li>

                            <!-- Выйти -->
                            <li class="nav-item">
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <button class="nav-link" style="font-size: 20px;" type="text">Выйти</button>

                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- End Пункты меню -->
                </div>
                <!-- End Меню справа -->
            @endauth

        </div>
    </nav>


    @yield('content')

</body>

</html>
