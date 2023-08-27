@extends('schems.topPanelSchema')

@section('title')
    Новости
@endsection

@section('content')
    <div class="container mt-3">

        @include('schems.topName', ['name' => "Новости"])
        @foreach ($news as $new)
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <a href="{{ route('news') }}/{{ $new->id }}" class="nav-link">
                        <h5 class="card-title">{{ $new->name }}</h5>
                        <p class="card-text">{{ $new->about }}</p>
                    </a>
                </div>
                @auth('web')
                    @if (Auth::user()->is_admin)
                        <div class="card-footer">
                            <a class="btn btn-danger"
                                href="{{ route('deleteNew_process', ['id' => $new->id]) }}">Удалить новость</a>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
@endsection
