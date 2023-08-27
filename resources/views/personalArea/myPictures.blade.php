@extends('schems.topPanelSchema')

@section('title')
    Мои картины
@endsection


@section('content')
    <div class="container-fluid mt-3">
        @include('schems.alerts', ['alterStatus' => 'seccues'])
        @include('schems.topName', ['name' => 'Мои картины'])

        @include('schems.search', ['search' => 'searchMyPictures'])

        <div class="container" id="search-results">
            <div class="row row-cols-1 row-cols-md-3 mt-0 g-3">
                @foreach ($images as $image)
                    <div class="card-group">
                        <div class="card rounded"
                            style="display: flex; flex-direction: column; justify-content: space-between;">
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
                                <div class="card-footer">
                                    <a class="btn btn-warning" href="{{route('editMyPicture', ['id' => $image->id])}}">Редактировать запись</a>
                                    <!-- Кнопка-триггер модального окна -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#{{ $image->id }}">
                                        Удалить картину
                                    </button>
                                </div>
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
    </div>
@endsection

<script>
    const searchQuery = document.getElementById('search-query');
    const searchResults = document.getElementById('search-results');

    searchQuery.addEventListener('input', function() {
        const query = searchQuery.value;
        if (query.length >= 3) { // Отправлять запрос после ввода хотя бы 3 символов
            fetch(`{{ route('search') }}?query=${query}`)
                .then(response => response.text())
                .then(data => {
                    searchResults.innerHTML = data;
                });
        } else {
            searchResults.innerHTML = '';
        }
    });
</script>

<style>
    /* Добавляем медиа-запрос для экранов шириной до 576px */
    @media (max-width: 576px) {
        .input-group-append {
            display: block;
            /* Переключаем на блочный элемент */
        }

        .form-select {
            max-width: 190px;

        }
    }

    @media (min-width: 577px) {
        .input-group-append {
            display: flex;
            width: 100%;
            /* Переключаем на блочный элемент */
        }

        .form-select {
            max-width: 190px;

        }

        .form-control {
            width: 100%;
        }
    }
</style>
