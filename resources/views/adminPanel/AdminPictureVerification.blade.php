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
                                    <a href="{{ route('pictureAccepting', ['id' => $image->id]) }}"
                                        class="btn btn-outline-success">Принять</a>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <!-- Модальное окно -->
                    <div class="modal fade" id="{{ $image->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Удаление картины</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Закрыть"></button>
                                </div>
                                <div class="modal-body">
                                    Вы действительно хотите удалить - {{ $image->name }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Закрыть</button>
                                    <a class="btn btn-danger"
                                        href="{{ route('deletePicture', ['id' => $image->id]) }}">Удалить картину</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
