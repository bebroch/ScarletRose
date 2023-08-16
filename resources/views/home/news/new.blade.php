@extends('schems.topPanelSchema')


@section('content')

<div style="margin: 40px">
    <div>
        <h1>{{$new->name}}</h1>
        <h5>{{$new->created_at}}</h5>
        <h4>{{$new->about}}</h4>
    </div>
</div>


@endsection
