@extends('schems.topPanelSchema')

@section('title')
{{$user->login}}
@endsection

@section('content')


<div class="container">
    <img src="" class="card-img-top">
    <div class="card-body">
        @if (!$user->is_admin)
            <form action="">
                <input type="submit" name="userName" value="Удалить пользователя - {{$user->login}}">
            </form>
        @endif
        <h1 class="card-title">{{$user->login}}</h1>
        <h2 class="card-title">{{$user->firstname}} {{$user->lastname}}</h2>
        <h4 class="card-title">{{$user->email}}</h4>
        <h4 class="card-title">{{$user->phone}}</h4>
        <h3 class="card-text">{{ Str::limit($user->about, 50, '...')}}</h3>
    </div>
</div>


@endsection
