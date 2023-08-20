@extends('schems.topPanelSchema')

@section('title')
    Картины
@endsection

@section('content')
    <div class="row g-0 p-5">

        @foreach ($images as $image)
            <div class="col">
                <div class="card" style="width: 27em">

                    <img src="{{ Storage::url("$image->imagePath") }}" class="card-img-top">
                    <div class="card-body">
                        <a href="{{ route('home') }}/{{ $image->id }}">
                            <h3 class="card-title">{{ $image->name }}</h3>
                            <p class="card-text">{{ Str::limit($image->about, 100, '...') }}</p>
                            @if ($image->price)
                                <p>Стоимость: {{ $image->price }}&#8381;</p>
                            @endif
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
            </div>
        @endforeach
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
                    <form action="{{ route('deletePicture') }}">
                        <input type="text" hidden value="{{ $image->id }}" name="image">
                        <input class="btn btn-danger" type="submit" value="Удалить картину">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
