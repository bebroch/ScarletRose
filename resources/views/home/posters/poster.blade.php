@extends('schems.topPanelSchema')


@section('content')




<div class="container mt-3">
    @include('schems.backbutton')

    <div class="card p-4">
        <h1>{{$poster->name}}</h1>
        <h5>{{$poster->timeSpending}}</h5>
        <h4>{{$poster->about}}</h4>
        <h6>{{$poster->location}}</h6>
    </div>
</div>


@endsection
