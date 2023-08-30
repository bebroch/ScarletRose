@extends('schems.topPanelSchema')

@section('title')
    Новости
@endsection

@section('content')
    <div class="container mt-3">

        @include('schems.topName', ['name' => 'Новости'])
        @foreach ($news as $theNews)
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <a href="{{ route('news') }}/{{ $theNews->id }}" class="nav-link">
                        <h5 class="card-title">{{ $theNews->name }}</h5>
                        <p class="card-text">{{ $theNews->about }}</p>
                    </a>
                </div>
                @auth('web')
                    @if (Auth::user()->is_admin)
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#{{ $theNews->id }}">
                                Удалить новость
                            </button>
                        </div>

                        @include('schems.deleteItemModalWindow', [
                            'item' => $theNews,
                            'route' => 'deleteNews_process',
                            'nameShape1' => 'новости',
                            'nameShape2' => 'новость',
                        ])
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
@endsection
