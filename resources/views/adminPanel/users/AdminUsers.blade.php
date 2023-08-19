@extends('schems.topPanelSchema')

@section('title')
Пользователи
@endsection

@section('content')


<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($users as $user)
            <div class="col">
                <a href="{{route('AdminUser', ['id' => $user->id])}}">
                    <div class="card">
                        <img src="" class="card-img-top">
                        <div class="card-body">
                            <h2 class="card-title">{{$user->login}}</h2>
                            <h4 class="card-title">{{$user->firstname}} {{$user->lastname}}</h4>
                            <h6 class="card-title">{{$user->email}}</h6>
                            <h6 class="card-title">{{$user->phone}}</h6>
                            <p class="card-text">{{ Str::limit($user->about, 50, '...')}}</p>
                            @if (!$user->is_admin)
                                <form action="{{route('deleteUser', ['id' => $user->id])}}">
                                    <input type="submit" name="userName" value="Удалить пользователя - {{$user->login}}">
                                </form>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>


@endsection
