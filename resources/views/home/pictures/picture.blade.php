@extends('schems.topPanelSchema')

@section('content')

<div style="margin: 40px">
    <img style="float: left" width="400" src="{{Storage::url("$image->imagePath")}}">
    <div>
        <h1>{{$image->name}}</h1>
        <h3>{{$user}}</h3>
        @if (DB::table('under_categories_pictures')->where('picture_id', '=', $image->id)->get()->first())
            <h3>Категории:
        @endif
        @foreach (DB::table('under_categories_pictures')->where('picture_id', '=', $image->id)->get() as $category)
            {{DB::table('under_categories')->find($category->under_category_id )->name}},
        @endforeach
        <h3>О картине:</h3>
        <h4>{{$image->about}}</h4>
        @if ($image->price)
            <h4>Стоимость: {{$image->price}}&#8381;</h4>
        @endif
        @if (Auth::user()->is_admin)
        <form action="{{route('deletePicture')}}">
            <input type="text" hidden value="{{$image->id}}" name="image">
            <input type="submit" value="Удалить картину">
        </form>
        @endif
    </div>
</div>



@endsection
