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


        </div>
        <div class="btn-group mt-2">
            <button type="button" class="btn btn-danger">По автору</button>
            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">От А до Я</a></li>
                <li><a class="dropdown-item" href="#">От Я до А</a></li>
            </ul>
        </div>
    </div>
</div>
