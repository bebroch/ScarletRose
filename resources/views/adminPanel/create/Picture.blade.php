@extends('schems.topPanelSchema')

@section('title')
    Добавить картину
@endsection

@section('content')
    <form action="{{ route('createUserPicture_process') }}" method="POST" enctype="multipart/form-data">
        <div class="container-fluid mt-3">
            <div class="row row-cols-1 row-cols-md-2 mt-1 g-3 justify-content-center">

                <div class="col-1" style="max-width: 25rem; min-width:23rem;">
                    <div class="card p-4">
                        @csrf
                        <h3>Добавить картину</h3>


                        <div class="mb-3">
                            <h5>Пользователь</h5>
                            <div class="mb-2">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">Имя</span>
                                    <input type="text" name="UserFirstName" class="form-control"
                                        placeholder="Имя автора картины">
                                </div>
                                @error('UserFirstName')
                                    <a class="link-danger link-underline-opacity-0"
                                        style="text-decoration: none;">{{ $message }}</a>
                                @enderror
                            </div>

                            <div>
                                <div class="input-group">
                                    <span class="input-group-text">Фамилия</span>
                                    <input type="text" name="UserLastName" class="form-control"
                                        placeholder="Фамилия автора картины">
                                </div>
                                @error('UserLastName')
                                    <a class="link-danger link-underline-opacity-0"
                                        style="text-decoration: none;">{{ $message }}</a>
                                @enderror
                            </div>
                        </div>



                        <div class="mb-3">
                            <h5>Фото</h5>
                            <input class="form-control" type="file" id="formFile"
                                accept="image/png, image/jpeg, image/jpg" name="uploadPicture" onchange="loadFile(event)">
                            @error('uploadPicture')
                                <a class="link-danger link-underline-opacity-0"
                                    style="text-decoration: none;">{{ $message }}</a>
                            @enderror
                        </div>

                        <h5>Название</h5>
                        <textarea name="namePicture" style="width: 100%; max-height: 65px" cols="1" rows="3"
                            placeholder="Название картины"></textarea>
                        @error('namePicture')
                            <a class="link-danger link-underline-opacity-0"
                                style="text-decoration: none;">{{ $message }}</a>
                        @enderror

                        <div class="col text-center">
                            <button type="button" class="btn btn-outline-success mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#techniqueWindow">
                                Выбрать технику
                            </button>
                            <button type="button" class="btn btn-outline-info mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#exhibitionWindow">
                                Выбрать выставку
                            </button>
                        </div>

                        <table>
                            <tr>
                                <td>
                                    <h5>Высота</h5>
                                    <input name="height" style="width: 80%">см
                                    @error('height')
                                        <a class="link-danger link-underline-opacity-0"
                                            style="text-decoration: none;">{{ $message }}</a>
                                    @enderror
                                </td>
                                <td>
                                    <h5>Ширина</h5>

                                    <input name="width" style="width: 80%">см
                                    @error('width')
                                        <a class="link-danger link-underline-opacity-0"
                                            style="text-decoration: none;">{{ $message }}</a>
                                    @enderror
                                </td>
                            </tr>
                        </table>

                        <div class="mt-2 text-center">
                            <h5>Год написания картины</h5>
                            <input type="number" min="1900" max="2150" step="1"
                                value="{{ now()->format('Y') }}" name="yearCreate" style="width: 40%">г.
                            @error('yearCreate')
                                <a class="link-danger link-underline-opacity-0"
                                    style="text-decoration: none;">{{ $message }}</a>
                            @enderror
                        </div>

                        <div class="mt-2">
                            <h5>О картине</h5>
                            <textarea name="aboutPicture" placeholder="Расскажите о чём ваша картина"
                                style="width: 100%; height:100px; max-height: 300px" cols="1" rows="10"></textarea>
                            @error('aboutPicture')
                                <a class="link-danger link-underline-opacity-0"
                                    style="text-decoration: none;">{{ $message }}</a>
                            @enderror
                        </div>


                        @error('price')
                            <a class="link-danger link-underline-opacity-0"
                                style="text-decoration: none;">{{ __($message) }}</a>
                        @enderror

                        @error('exhibitions')
                            <a class="link-danger link-underline-opacity-0"
                                style="text-decoration: none;">{{ $message }}</a>
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
        @include('schems.modalWindowTechnique')


        <!-- Модальное окно -->
        @include('schems.modalWindowExhibitions', ['pressCheck' => false])

    </form>
    <style>
        .activeCheckBox:checked~.cheboxContainer {
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
