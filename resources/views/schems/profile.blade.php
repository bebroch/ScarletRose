@extends('schems.topPanelSchema')

@section('title')
{{$user->login}}
@endsection


@section('content')
    <div class="container-fluid">

        <div class="mt-3">
            @include('schems.topName')
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card text-center p-3">
                        <h3>{{ $user->login }}</h3>
                        <h5>{{ $user->firstname }} {{ $user->lastname }}</h5>
                        <h6>{{ $user->email }}</h6>
                        <h6>{{ $user->phone }}</h6>
                        <h4>{{ $user->about }}</h4>
                    </div>
                </div>
                @if (!empty($images->first()))
                    <div class="col-md">
                        <div class="card p-3 pt-1">
                            @include('home.pictures.formPictures')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
