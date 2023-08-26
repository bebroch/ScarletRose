@extends('schems.topPanelSchema')


@section('content')

<div class="container-fluid m-5 mt-2">
    <div>
        <h1>{{$user->login}}</h1>
        <h5>{{$user->firstname}} {{$user->lastname}}</h5>
        <h6>{{$user->email}}</h6>
        <h6>{{$user->phone}}</h6>
        <h6>{{$user->about}}</h6>
    </div>
</div>


@endsection
