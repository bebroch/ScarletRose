@extends('schems.topPanelSchema')

@section('title')
    Мои картины
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container mt-3 g-3" style="width: 30%">
            <form id="search-form" action="{{ route('search') }}" method="GET">
                <div class="input-group">

                    <input name="query" id="search-query" type="text" class="form-control rounded" placeholder="Поиск"
                        aria-label="Search" aria-describedby="search-addon" />

                    <!-- Вставьте выпадающий список сюда -->
                    <div class="input-group-append">
                        <select class="form-select" name="filter">
                            <option value="name">Название картины</option>
                            <option value="about">О картине</option>
                            <option value="size">Размер</option>
                            <option value="category">Категории</option>
                            <option value="under_category">Теги</option>
                            <!-- Добавьте другие опции по мере необходимости -->
                        </select>
                    </div>
                    <!-- Конец выпадающего списка -->

                    <input type="submit" class="btn btn-outline-primary" value="Поиск">
                </div>
            </form>

            @if (!$images->first() && !empty($query))
                По запросу "{{ $query }}" ничего не удалось найти в разделе.
            @endif
        </div>
        <div id="search-results">
            <div class="row row-cols-1 row-cols-md-3 m-5 mt-3 g-3">
                @foreach ($images as $image)
                    <div class="col">
                        <div class="card">
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
                                    <a class="btn btn-warning" href="{{route('editMyPicture', ['id' => $image->id])}}">Редактировать запись</a><br>
                                    <!-- Кнопка-триггер модального окна -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        Удалить картину
                                    </button>
                                @endauth
                            </div>
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
                        <a class="btn btn-danger" href="{{ route('deleteMyPicture', ['id' => $image->id]) }}">Удалить</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
