<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="filters" aria-labelledby="offcanvasDarkNavbarLabel">
    <div class="offcanvas-header" style="background-color: #405b48;">
        <h5 class="offcanvas-title" style="font-size: 40px">Фильтры</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>

    </div>

    <div class="offcanvas-body" style="background-color: #405b48;">

        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

            {{-- Сортировка по Автору --}}
            <li class="nav-item">
                <a style="font-size: 20px" class="nav-link" data-bs-toggle="collapse" href="#Author">
                    Авторы
                </a>
                <div class="collapse" id="Author">
                    <div class="card card-body" style="background-color: #c3c1cf;">

                        <input type="radio" class="btn-check" name="filters" id="AuthorAtoZ" autocomplete="off">
                        <label class="btn btn-outline-primary" for="AuthorAtoZ">От А до Я</label>

                        <input type="radio" class="btn-check" name="filters" id="AuthorZtoA" autocomplete="off">
                        <label class="btn btn-outline-primary" for="AuthorZtoA">От Я до А</label>
                        <a style="font-size: 20px" class="nav-link" data-bs-toggle="collapse" href="#Authors">
                            Все авторы
                        </a>
                        <div class="collapse" id="Authors">
                            <div class="card card-body" style="background-color: #c3c1cf;">

                                <input type="radio" class="btn-check" name="filters" id="AuthorAtoZ"
                                    autocomplete="off">
                                <label class="btn btn-outline-primary" for="AuthorAtoZ">От А до Я</label>

                                <input type="radio" class="btn-check" name="filters" id="AuthorZtoA"
                                    autocomplete="off">
                                <label class="btn btn-outline-primary" for="AuthorZtoA">От Я до А</label>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            {{-- Сортировка по Названию --}}
            <li class="nav-item">
                <a style="font-size: 20px" class="nav-link" data-bs-toggle="collapse" href="#Name">
                    Названия
                </a>
                <div class="collapse" id="Name">
                    <div class="card card-body" style="background-color: #c3c1cf;">

                        <input type="radio" class="btn-check" name="filters" id="NameAtoZ" autocomplete="off">
                        <label class="btn btn-outline-primary" for="NameAtoZ">От А до Я</label>

                        <input type="radio" class="btn-check" name="filters" id="NameZtoA" autocomplete="off">
                        <label class="btn btn-outline-primary" for="NameZtoA">От Я до А</label>

                    </div>
                </div>
            </li>

            {{-- Сортировка по размеру --}}
            <li class="nav-item">
                <a style="font-size: 20px" class="nav-link" data-bs-toggle="collapse" href="#Size">
                    Размер
                </a>
                <div class="collapse" id="Size">
                    <div class="card card-body" style="background-color: #c3c1cf;">
                        <input type="radio" class="btn-check" name="filters" id="SizeManytoFew" autocomplete="off">
                        <label class="btn btn-outline-primary" for="SizeManytoFew">От Большего к Меньшему</label>

                        <input type="radio" class="btn-check" name="filters" id="SizeFewtoMany"
                            autocomplete="off">
                        <label class="btn btn-outline-primary" for="SizeFewtoMany">От Меньшего к Большему</label>
                    </div>
                </div>
            </li>

            {{-- Сортировка по Тегу --}}
            <li class="nav-item">
                <a style="font-size: 20px" class="nav-link" data-bs-toggle="collapse" href="#Tag">
                    Тег
                </a>
                <div class="collapse" id="Tag">
                    <div class="card card-body" style="background-color: #c3c1cf;">
                        <input type="radio" class="btn-check" name="filters" id="TagAtoZ" autocomplete="off">
                        <label class="btn btn-outline-primary" for="TagAtoZ">От А до Я</label>

                        <input type="radio" class="btn-check" name="filters" id="TagZtoA" autocomplete="off">
                        <label class="btn btn-outline-primary" for="TagZtoA">От Я до А</label>
                    </div>
                </div>
            </li>

            {{-- Сортировка по Участие в выставке --}}
            <li class="nav-item">
                <a style="font-size: 20px" class="nav-link" data-bs-toggle="collapse" href="#Exhibitions">
                    Выставки
                </a>
                <div class="collapse" id="Exhibitions">
                    <div class="card card-body" style="background-color: #c3c1cf;">
                        <input type="radio" class="btn-check" name="filters" id="ExhibitionAtoZ"
                            autocomplete="off">
                        <label class="btn btn-outline-primary" for="ExhibitionAtoZ">От А до Я</label>

                        <input type="radio" class="btn-check" name="filters" id="ExhibitionZtoA"
                            autocomplete="off">
                        <label class="btn btn-outline-primary" for="ExhibitionZtoA">От Я до А</label>
                    </div>
                </div>
            </li>

            {{-- Сортировка по Цена --}}
            <li class="nav-item">
                <a style="font-size: 20px" class="nav-link" data-bs-toggle="collapse" href="#Price">
                    Цена
                </a>
                <div class="collapse" id="Price">
                    <div class="card card-body" style="background-color: #c3c1cf;">
                        <input type="radio" class="btn-check" name="filters" id="PriceManytoFew"
                            autocomplete="off">
                        <label class="btn btn-outline-primary" for="PriceManytoFew">От А до Я</label>

                        <input type="radio" class="btn-check" name="filters" id="PriceFewtoMany"
                            autocomplete="off">
                        <label class="btn btn-outline-primary" for="PriceFewtoMany">От Я до А</label>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
