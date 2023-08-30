@extends('schems.topPanelSchema')

@section('title')
    Добавить картину
@endsection

@section('content')
    <form action="{{ route('createPicture_process') }}" method="POST" enctype="multipart/form-data">
        <div class="container-fluid mt-3">
            <div class="container">

                @include('schems.alerts', ['alterStatus' => 'danger'])
            </div>
            <div class="row row-cols-1 row-cols-md-2 mt-1 g-3 justify-content-center">

                <div class="col-1" style="max-width: 25rem; min-width:23rem;">
                    <div class="card p-4">
                        @csrf
                        <h3>Добавить картину</h3>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Фото</label>
                            <input @if ($isDisable) disabled @endif class="form-control" type="file"
                                id="formFile" accept="image/png, image/jpeg, image/jpg" name="uploadPicture"
                                onchange="loadFile(event)">
                            @error('uploadPicture')
                                <br><a>{{ $message }}</a>
                            @enderror
                        </div>

                        <label for="namePicture">Название</label>
                        <textarea @if ($isDisable) disabled @endif name="namePicture" style="width: 100%; max-height: 65px"
                            cols="1" rows="3" placeholder="Название картины"></textarea>
                        @error('namePicture')
                            <br><a>{{ $message }}</a>
                        @enderror

                        <div class="col text-center">
                            <!-- Button trigger modal -->
                            <button @if ($isDisable) disabled @endif type="button"
                                class="btn btn-outline-success mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#techniqueWindow">
                                Выбрать технику
                            </button>
                            <!-- Button trigger modal -->
                            <button @if ($isDisable) disabled @endif type="button"
                                class="btn btn-outline-info mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#exhibitionWindow">
                                Выбрать выставку
                            </button>
                        </div>

                        <table>
                            <tr>
                                <td>
                                    <label>Высота<br>
                                        <input @if ($isDisable) disabled @endif name="height"
                                            style="width: 80%">см</label>
                                    @error('height')
                                        <a>{{ $message }}</a>
                                    @enderror
                                </td>
                                <td>
                                    <label>Ширина<br>
                                        <input @if ($isDisable) disabled @endif name="width"
                                            style="width: 80%">см</label>
                                    @error('width')
                                        <a>{{ $message }}</a>
                                    @enderror
                                </td>
                            </tr>
                        </table>

                        <div class="mt-2 text-center">
                            <label>Год написания картины<br>
                                <input type="number" min="1900" max="2150" step="1" value="{{now()->format('Y')}}" @if ($isDisable) disabled @endif name="yearCreate"
                                    style="width: 40%">г.</label>
                            @error('yearCreate')
                                <a>{{ $message }}</a>
                            @enderror
                        </div>

                        <div class="mt-2">
                            <label>О картине</label>
                            <textarea @if ($isDisable) disabled @endif name="aboutPicture" placeholder="Расскажите о чём ваша картина"
                                style="width: 100%; height:100px; max-height: 300px" cols="1" rows="10"></textarea>
                            @error('aboutPicture')
                                <a>{{ $message }}</a>
                            @enderror
                        </div>


                        @error('price')
                            <br><a>{{ __($message) }}</a>
                        @enderror

                        @error('exhibitions')
                            <br><a>{{ $message }}</a>
                        @enderror

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input @if ($isDisable) disabled @endif class="btn btn-primary mt-3"
                                type="submit">
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
        @include('schems.modalWindowTechnique')


        <!-- Модальное окно -->
        @include('schems.modalWindowExhibitions', ['pressCheck' => false])

    </form>
    <style>
        .activeCheckBox:checked ~ .cheboxContainer {
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
