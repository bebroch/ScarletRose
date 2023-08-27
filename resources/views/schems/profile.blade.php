@extends('schems.topPanelSchema')

@section('title')
    {{ $user->login }}
@endsection


@section('content')
    <div class="container-fluid">
        <div class="mt-3">
            @include('schems.topName')
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card text-center p-3">
                        <h3>{{ $user->login }}</h3>
                        <h5>{{ $user->firstname }} {{ $user->lastname }}</h5>
                        <h6>{{ $user->email }}
                            @auth('web')
                                @if (Auth::user()->is_admin)
                                    @if (!empty($user->email_verified_at))
                                        ✅
                                    @else
                                        ❌
                                    @endif
                                @endif
                            @endauth
                            </h4>
                        </h6>
                        <h6>{{ $user->phone }}</h6>
                        <h4>{{ $user->about }}</h4>
                        @auth('web')
                            @if (Auth::user()->is_admin)
                                @if (!$user->is_admin)
                                <div class="mx-auto">
                                    <button type="button" class="btn btn-danger" style="width: 100%" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        Удалить пользователя
                                    </button>
                                </div>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
                @if (!empty($images->first()))
                    <div class="col-md">
                        <div class="card p-3 pt-1">
                            @include('home.pictures.formPictures')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
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
