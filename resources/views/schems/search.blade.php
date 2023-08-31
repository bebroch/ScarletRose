<div class="container mt-3 g-3">
    <div class="container-sm input-group">
        <div class="input-group-append" style="width:100%">


            <input name="query" id="search-query" type="text" class="form-control rounded" placeholder="Поиск"
                aria-label="Search" aria-describedby="search-addon">


            <select class="form-select text-center" id="filter-query" style="min-width: 150px">
                <option value="name">По названию</option>
                <option value="about">По описанию</option>
                <option value="size">По размеру</option>
                <option value="under_category">По тегу</option>
                <!-- Добавьте другие опции по мере необходимости -->
            </select>

            <button id="search-button" class="btn btn-outline-primary">Поиск</button>
            <button id="search-button" data-bs-toggle="offcanvas" data-bs-target="#filters"
                class="btn btn-outline-primary">фильтры</button>


        </div>


        @include('schems.pictures.sortPictures')

    </div>
</div>
