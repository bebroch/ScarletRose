@extends('schems.topPanelSchema')

@section('content')

<div style="margin: 40px">
    <img style="float: left" width="400" src="{{Storage::url("$image->imagePath")}}">
    <div>
        <h1>{{$image->name}}</h1>
        <h3>{{$user}}</h3>
        <h4>{{$image->about}}</h4>
    </div>
</div>



@endsection
