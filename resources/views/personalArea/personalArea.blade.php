@extends('schems.topPanelSchema')

@section('title')
    Личная страница
@endsection


@section('content')
@include('schems.profile', ['user' => Auth::user(), 'name' => 'Личная страница'])
@endsection
