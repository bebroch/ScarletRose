@extends('schems.topPanelSchema')

@section('title')
    Модерация картин
@endsection

@section('content')
    <div class="container mt-3">
        @include('schems.alerts', ['alterStatus' => 'success'])

        @include('schems.topName', ['name' => 'Модерация картин'])


        @if (empty($images->first()))
            <div class="container-fluid text-center">
                Пока что ничего нет.
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-3 mt-0 g-3 mb-3">
            @foreach ($images as $image)
                <div class="card-group">
                    <div class="card rounded" style="display: flex; flex-direction: column; justify-content: space-between;">
                        <a class="nav-link" href="{{ route('home') }}/{{ $image->id }}">
                            <img src="{{ Storage::url("$image->imagePath") }}" class="card-img-top rounded"
                                style="object-fit: cover; max-height: 30vh">
                            <div class="card-body">
                                <h3 class="card-title">{{ $image->name }}</h3>
                                <p class="card-text">{{ Str::limit($image->about, 100, '...') }}</p>
                                @if ($image->price)
                                    <p>Стоимость: {{ $image->price }}&#8381;</p>
                                @endif
                            </div>
                        </a>
                        @auth('web')
                            @if (Auth::user()->is_admin)
                                <div class="card-footer d-flex justify-content-around">
                                    <!-- Кнопка-триггер модального окна -->
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#{{ $image->id }}">
                                        Отклонить
                                    </button>
                                    <a href="{{ route('adminpictureAccept_process', ['id' => $image->id]) }}"
                                        class="btn btn-outline-success">Принять</a>
                                </div>
                            @endif
                        @endauth
                    </div>

                    @include('schems.deleteItemModalWindow', [
                        'item' => $image,
                        'route' => 'adminPictureDelete_process',
                        'nameShape1' => 'картины',
                        'nameShape2' => 'картину'
                    ])
                </div>
            @endforeach
        </div>
    </div>
@endsection
