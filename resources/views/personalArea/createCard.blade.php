@extends('schems.topPanelSchema')

@section('title')
    Добавить картину
@endsection

@section('content')
    <form action="{{ route('adderPicture') }}" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-2 mt-1 g-3 justify-content-center">
                <div class="col-1 card" style="max-width: 23rem; min-width:20rem">
                    <div class="card-body">
                        @csrf
                        <h3>Добавление Картины</h3>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Фото</label>
                            <input class="form-control" type="file" id="formFile"
                                accept="image/png, image/jpeg, image/jpg" name="uploadPicture" onchange="loadFile(event)">
                            @error('uploadPicture')
                                <br><a>{{ $message }}</a>
                            @enderror
                        </div>

                        <label for="namePicture">Название</label><br>
                        <textarea name="namePicture" style="width: 100%; max-height: 65px" cols="1" rows="3"></textarea>
                        @error('namePicture')
                            <br><a>{{ $message }}</a>
                        @enderror

                        <div class="col text-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#techniqueWindow">
                                Выбрать технику
                            </button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-info mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#exhibitionWindow">
                                Выбрать выставку
                            </button>
                        </div>

                        <label>О картине</label><br>
                        <textarea name="aboutPicture" style="width: 100%; height:100px; max-height: 300px" cols="1" rows="10"></textarea>
                        @error('aboutPicture')
                            <a>{{ $message }}</a>
                        @enderror

                        @error('price')
                            <br><a>{{ $message }}</a>
                        @enderror

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input class="btn btn-primary mt-3" type="submit">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center" id="filePreviewBlockId">
                            <img id="filePreview" style="max-width: 100%; max-height: 80vh">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно -->
        <div class="modal fade" id="techniqueWindow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Добавить техники</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-cols-1 row-cols-md-3 g-1">
                            @foreach ($categories as $category)
                                <div>
                                    <div>
                                        @if (!DB::table('under_categories')->where('category_id', '=', $category->id)->get()->first())
                                            <label style="font-size: 18px; font-weight:bold"
                                                for="{{ $category->id }} {{ $category->name }}">{{ $category->name }}</label>
                                            <input type="checkbox"
                                                name="technique, {{ $category->id }},{{ $category->id }}"><br>
                                        @else
                                            <label style="font-size: 18px; font-weight:bold"
                                                for="{{ $category->id }} {{ $category->name }}">{{ $category->name }}</label><br>
                                        @endif
                                    </div>
                                    <div>
                                        @foreach (DB::table('under_categories')->where('category_id', '=', $category->id)->get() as $item)
                                            <ul class="list-group mt-1">

                                                <label>
                                                    <li class="list-group-item">
                                                        <input style="width: 15px" type="checkbox"
                                                            id="{{ $category->name }}"
                                                            name="technique,{{ $category->id }},{{ $item->id }}"
                                                            onclick="onlyOne(this, '{{ $category->name }}')">
                                                        {{ $item->name }}
                                                    </li>

                                                </label>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div>
                                <input type="checkbox"
                                    onclick="var input = document.getElementById('price'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}">
                                <label style="font-size: 18px; font-weight:bold" for="На продажу">На продажу</label>
                                <input disabled name="price" id="price" style="width:90%">
                                <label for="price">&#8381;</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Добавить</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модальное окно -->
        <div class="modal fade" id="exhibitionWindow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Добавить на выставки</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Активные выставки</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">Будущие
                                    выставки</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                @foreach (DB::table('exhibitions')->where([['start_at', '<', now()], ['end_at', '>', now()]])->get() as $exhibition)
                                    <label>
                                        <input class="activeCheckBox" hidden type="checkbox" name="exhibitions, {{ $exhibition->title }}">
                                        <div class="card mb-3 cheboxContainer" style="max-width: 540px;">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img src="..." class="img-fluid rounded-start" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $exhibition->title }}</h5>
                                                        <p class="card-text">{{ $exhibition->about }}</p>
                                                        <p class="card-text"><small class="text-muted">Выставка началась

                                                                {{ Carbon\Carbon::parse($exhibition->start_at)->diffForHumans() }}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </label>
                                @endforeach

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @foreach (DB::table('exhibitions')->where([['start_at', '>', now()]])->get() as $exhibition)
                                    <label>

                                        <input class="activeCheckBox" hidden type="checkbox" name="exhibitions, {{ $exhibition->title }}">
                                        <div class="card mb-3 cheboxContainer" style="max-width: 540px;">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img src="..." class="img-fluid rounded-start" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class=" card-body">
                                                        <h5 class="card-title">{{ $exhibition->title }}</h5>
                                                        <p class="card-text">{{ $exhibition->about }}</p>
                                                        <p class="card-text"><small class="text-muted">Выставка начнётся

                                                                {{ Carbon\Carbon::parse($exhibition->start_at)->diffForHumans() }}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Добавить</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <style>
        .activeCheckBox:checked ~ .cheboxContainer{
            background-color: #def1ff;
        }

        </style>
@endsection

<script>
    var loadFile = function(event) {
        var output = document.getElementById("filePreview");
        var div = document.getElementById('filePreviewBlockId');

        output.src = URL.createObjectURL(event.target.files[0]);

        output.onload = function() {
            URL.revokeObjectURL(output.src);
        };
    };


    var onlyOne = function(checkbox, checkboxNameId) {

        var checkboxes = document.querySelectorAll('[id="' + checkboxNameId + '"]');

        checkboxes.forEach(element => {
            if (element !== checkbox)
                element.checked = false;
        });
    };
</script>


