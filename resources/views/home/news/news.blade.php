@extends('schems.topPanelSchema')

@section('title')
Новости
@endsection

@section('content')

<div class="m-5">
    @foreach ($news as $new)
    <div class="card w-100 mb-3">
        <div class="card-body">
            <h5 class="card-title">{{$new->name}}</h5>
            <p class="card-text">{{$new->about}}</p>
            <a href="{{route('news')}}/{{$new->id}}" class="btn btn-primary">Смотреть</a>
        </div>
    </div>
    @endforeach
</div>

@endsection