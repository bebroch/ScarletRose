@extends('schems.topPanelSchema')

@section('title')
    Картины
@endsection


@section('content')


    <div class="container-fluid">
        <div class="container mt-3 g-3">
            @if (Session::has('status'))
                <div class="alert alert-success">
                    {{ Session::get('status') }}
                </div>
            @endif
            <form id="search-form" action="{{ route('search') }}" method="GET">
                <div class="container-sm input-group">

                    <div class="input-group-append" style="width:100%">
                        <input name="query" id="search-query" type="text" class="form-control rounded"
                            placeholder="Поиск" aria-label="Search" aria-describedby="search-addon">
                        <select class="form-select" name="filter">
                            <option value="name">Название картины</option>
                            <option value="about">О картине</option>
                            <option value="size">Размер</option>
                            <option value="category">Категории</option>
                            <option value="under_category">Теги</option>
                            <!-- Добавьте другие опции по мере необходимости -->
                            <input type="submit" class="btn btn-outline-primary" value="Поиск">
                        </select>
                    </div>
                </div>
            </form>

            @if (empty($images->first()) && !empty($query))
                По запросу "{{ $query }}" ничего не удалось найти.
            @endif


        </div>
        <div class="container" id="search-results">
            @include('home.pictures.formPictures')
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
