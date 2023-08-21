@extends('schems.topPanelSchema')

@section('title')
Добавить Выставку
@endsection

@section('content')

<div class="container">
    <form action="{{route('addingExhibition')}}">
        @csrf
        <input placeholder="Название выставки" type="text" name="title"><br>
        <label for="start_at">Дата начала</label>
        <input placeholder="Дата начала" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" type="date" name="start_at"><br>
        <label for="end_at">Дата окончания</label>
        <input placeholder="Дата окончания" type="date" name="end_at"><br>
        <textarea placeholder="О чём будет выставка" name="about" cols="30" rows="10"></textarea><br>
        <input type="submit">
    </form>
</div>

@endsection
