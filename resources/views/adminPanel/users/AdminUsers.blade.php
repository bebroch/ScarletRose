@extends('schems.topPanelSchema')

@section('title')
    Пользователи
@endsection

@section('content')
    <div class="container mt-3 mb-3">

        @include('schems.topName', ['name' => 'Пользователи'])
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($users as $user)
                <div class="col">

                    <div class="card">
                        <img src="" class="card-img-top">
                        <div class="card-body">
                            <a class="nav-link" href="{{ route('AdminUser', ['id' => $user->id]) }}">
                                <h2 class="card-title">{{ $user->login }}</h2>
                                <h4 class="card-title">{{ $user->firstname }} {{ $user->lastname }}</h4>
                                <h6 class="card-title">{{ $user->email }}</h6>
                                <h6 class="card-title">{{ $user->phone }}</h6>
                                <p class="card-text">{{ Str::limit($user->about, 50, '...') }}</p>
                            </a>
                            @if (!$user->is_admin)
                                <!-- Кнопка-триггер модального окна -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Удалить пользователя
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>


    <!-- Модальное окно -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Удаление пользователя</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    Вы действительно хотите удалить пользователя - {{ $user->login }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <form action="{{ route('deleteUser', ['id' => $user->id]) }}">
                        <input class="btn btn-danger" type="submit" name="userName"
                            value="Удалить пользователя - {{ $user->login }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
