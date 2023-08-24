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
                <img src="{{ asset('imagesAsset/logo.png') }}" height="70px" class="d-inline-block align-text-top">
            </a>


            @guest('web')
                <a class="navbar-brand" href="{{ route('login') }}" style="font-size: 28px;">Войти</a>
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
                        <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel">{{ Auth::user()->login }}</h3>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <!-- End Имя пользователя -->
                    <!-- Пункты меню -->
                    <div class="offcanvas-body" style="background-color: #405b48;">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <!-- Галерея -->
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}"
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
                                    <li><a class="dropdown-item" href="{{ route('myPictures') }}">Мои картины</a></li>
                                    <li><a class="dropdown-item" href="{{ route('addPicture') }}">Добавить картину</a></li>
                                    <li><a class="dropdown-item" href="#">Обо мне</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('updateInformation') }}">Изменить
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
                                            <a class="dropdown-item" href="{{ route('addNew') }}">Добавить новость</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('addPoster') }}">Добавить афишу</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('addExhibition') }}">Добавить
                                                выставку</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('AdminSearch') }}">Поиск</a></li>
                                        <li><a class="dropdown-item" href="{{ route('AdminUsers') }}">Пользователи</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('addCategory') }}">Категории</a></li>
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
                                <a class="nav-link" style="font-size: 20px;" aria-current="page"
                                    href="{{ route('logout') }}">Выйти</a>
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
