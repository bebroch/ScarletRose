@extends('schems.topPanelSchema')

@section('title')
Афиши
@endsection

@section('content')

<div class="m-5">
    @foreach ($posters as $poster)
    <div class="card w-100 mb-3">
        <div class="card-body">
            <h5 class="card-title">{{$poster->name}}</h5>
            <p class="card-text">{{$poster->about}}</p>
            <a href="{{route('posters')}}/{{$poster->id}}" class="btn btn-primary">Смотреть</a>
        </div>
    </div>
    @endforeach
</div>

@endsection
