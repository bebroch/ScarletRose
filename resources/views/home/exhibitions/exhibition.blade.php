@extends('schems.topPanelSchema')

@section('title')
    {{ $exhibition->title }}
@endsection

@section('content')
    <div class="container mt-3 mb-3">
        @include('schems.backbutton')
        <h1>{{ $exhibition->title }}</h1>
        <h6>{{ $exhibition->start_at }} {{ $exhibition->end_at }}</h6>
        <p>{{ $exhibition->about }}</p>

        @include('home.pictures.formPictures')


    </div>
@endsection
