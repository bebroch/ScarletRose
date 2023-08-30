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
                        <span class="border-bottom mb-3">
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
                        </span>

                        <h5>{{ $user->about }}</h5>

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
                @if (!empty($pictures->first()))
                    <div class="col-md mb-3">
                        <div class="card p-3">
                            @include('schems.topName', ['name' => 'Картины'])
                            @include('home.pictures.formPictures')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    @include('schems.deleteItemModalWindow', [
        'item' => $user,
        'route' => 'deleteUser_process',
        'nameShape1' => 'пользователя',
        'nameShape2' => 'пользователя',
    ])
@endsection
