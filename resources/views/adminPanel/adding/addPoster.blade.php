@extends('schems.topPanelSchema')

@section('title')
Добавить Афишу
@endsection

@section('content')

<div class="container">
    <form action="{{route('addingPoster')}}">
        @csrf
        <input placeholder="Заголовок афиши" type="text" name="title"><br>
        <input placeholder="Дата проведения афиши" type="date" name="date"><br>
        <input placeholder="Где будет проводится" type="text" name="location"><br>
        <textarea placeholder="Текст афиши" name="about" cols="30" rows="10"></textarea><br>
        <input type="submit">
    </form>
</div>

@endsection
