@extends('schems.topPanelSchema')

@section('title')

@endsection

@section('content')

<div class="container">
    <h1>{{$exhibition->title}}</h1>
    <h6>{{$exhibition->start_at}} {{$exhibition->end_at}}</h6>
    <p>{{$exhibition->about}}</p>

</div>

@endsection
