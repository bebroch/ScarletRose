@extends('schems.topPanelSchema')

@section('title')
    Картины
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-3 m-5 mt-3 g-3">
            @foreach ($images as $image)
                <div class="col">
                    <div class="card">
                        <a class="nav-link" href="{{ route('home') }}/{{ $image->id }}">
                            <img src="{{ Storage::url("$image->imagePath") }}" class="card-img-top">
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
                                <!-- Кнопка-триггер модального окна -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Удалить картину
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Модальное окно -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Удаление картины</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    Вы действительно хотите удалить - {{ $image->name }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <a class="btn btn-danger" href="{{route('deletePicture', ['id' => $image->id])}}">Удалить картину</a>
                </div>
            </div>
        </div>
    </div>
@endsection
