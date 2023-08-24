@extends('schems.topPanelSchema')

@section('title')
    {{ $user->login }}
@endsection

@section('content')
    <div class="container">
        <img src="" class="card-img-top">
        <div class="card-body">
            @if (!$user->is_admin)
                <!-- Кнопка-триггер модального окна -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Удалить пользователя
                </button>
            @endif
            <h1 class="card-title">{{ $user->login }}</h1>
            <h2 class="card-title">{{ $user->firstname }} {{ $user->lastname }}</h2>
            <h4 class="card-title">{{ $user->email }}
            @if (!empty($user->email_verified_at))
            ✅
            @else
            ❌
            @endif</h4>
            <h4 class="card-title">{{ $user->phone }}</h4>
            <h3 class="card-text">{{ $user->about }}</h3>
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
                        <input class="btn btn-primary" type="submit" name="userName"
                            value="Удалить пользователя - {{ $user->login }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
