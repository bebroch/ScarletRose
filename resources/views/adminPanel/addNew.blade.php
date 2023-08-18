@extends('schems.topPanelSchema')

@section('title')
Добавить Новость
@endsection

@section('content')

<div class="container">
    <form action="{{route('addingNew')}}">
        @csrf
        <input placeholder="Заголовок" type="text" name="title"><br>
        <textarea placeholder="Текст новости" name="about" id="" cols="30" rows="10"></textarea><br>
        <input type="submit">
    </form>
</div>

@endsection
