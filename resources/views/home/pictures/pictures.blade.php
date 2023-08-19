@extends('schems.topPanelSchema')

@section('title')
Картины
@endsection

@section('content')

<div class="row g-0 p-5">

    @foreach ($images as $image)
    <div class="col">
        <div class="card" style="width: 27em">
            <a href="{{route('home')}}/{{$image->id}}">
                <img src="{{ Storage::url("$image->imagePath") }}" class="card-img-top" >
                <div class="card-body">
                    <h3 class="card-title">{{$image->name}}</h3>
                    <p class="card-text">{{Str::limit($image->about, 100, '...')}}</p>
                    @if ($image->price)
                        <p>Стоимость: {{$image->price}}&#8381;</p>
                    @endif
                    @auth('web')
                    @if (Auth::user()->is_admin)
                    <form action="{{route('deletePicture')}}">
                        <input type="text" hidden value="{{$image->id}}" name="image">
                        <input type="submit" value="Удалить картину">
                    </form>
                    @endif
                    @endauth
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>


@endsection
