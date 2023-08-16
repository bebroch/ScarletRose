@extends('schems.topPanelSchema')


@section('content')

<div style="margin: 40px">
    <div>
        <h1>{{$poster->name}}</h1>
        <h5>{{$poster->timeSpending}}</h5>
        <h4>{{$poster->about}}</h4>
        <h6>{{$poster->location}}</h6>
    </div>
</div>


@endsection
