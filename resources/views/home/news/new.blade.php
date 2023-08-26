@extends('schems.topPanelSchema')


@section('content')

<div class="container mt-3">
    @include('schems.backbutton')
    <div class="card p-4">
        <h1>{{$new->name}}</h1>
        <h5>{{$new->created_at}}</h5>
        <h4>{{$new->about}}</h4>
    </div>
</div>


@endsection
