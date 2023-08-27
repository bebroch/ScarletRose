<div class="container mt-3 g-3">

    <form id="search-form" action="{{ route("$search") }}" method="GET">
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
