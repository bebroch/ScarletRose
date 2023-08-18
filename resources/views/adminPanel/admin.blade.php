@extends('schems.topPanelSchema')

@section('title')
Админ панель
@endsection

@section('content')

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand h1 fs-1" href="#">
            <img src="{{asset('imagesAsset/rose.png')}}" height="53px" class="d-inline-block align-text-top">
            Арт клуб "Алая роза"
          </a>
        </div>
      </nav>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h3 class="offcanvas-title" id="offcanvasDarkNavbarLabel">{{Auth::user()->login}}</h3>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Галерея</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Новости</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Афиша</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Личный кабинет
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="#">Мои картины</a></li>
                  <li><a class="dropdown-item" href="#">Добавить картину</a></li>
                  <li><a class="dropdown-item" href="#">Обо мне</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Изменить информацию</a></li>
                </ul>
            </li>


            @if (Auth::user()->is_admin)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Админ панель
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="{{route('addNew')}}">Добавить новость</a></li>
                  <li><a class="dropdown-item" href="{{route('addPoster')}}">Добавить афишу</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="{{route('AdminSearch')}}">Поиск</a></li>
                  <li><a class="dropdown-item" href="{{route('AdminUsers')}}">Редактировать пользователей</a></li>
                  <li><a class="dropdown-item" href="{{route('addCategory')}}">Редактирование категорий</a></li>
                </ul>
            </li>
            @endif


            <li class="nav-item">
                <a class="nav-link active" aria-current="page"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"></a>
            </li>


            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="#">Выйти</a>
            </li>



          </ul>
        </div>
      </div>
    </div>
  </nav>
@endsection
