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
                        <div class="card-body">
                            <a class="nav-link" href="{{ route('adminUser', ['id' => $user->id]) }}">
                                <h2 class="card-title">{{ $user->login }}</h2>
                                <h4 class="card-title">{{ $user->firstname }} {{ $user->lastname }}</h4>
                                <h6 class="card-title">{{ $user->email }}</h6>
                                <h6 class="card-title">{{ $user->phone }}</h6>
                                <p class="card-text">{{ Str::limit($user->about, 50, '...') }}</p>
                            </a>
                        </div>
                        @if (!$user->is_admin)
                            <div class="card-footer">
                                <!-- Кнопка-триггер модального окна -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#{{ $user->id }}">
                                    Удалить пользователя
                                </button>
                            </div>

                            @include('schems.deleteItemModalWindow', [
                                'item' => $user,
                                'route' => 'deleteUser_process',
                                'nameShape1' => 'пользователя',
                                'nameShape2' => 'пользователя',
                            ])
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
