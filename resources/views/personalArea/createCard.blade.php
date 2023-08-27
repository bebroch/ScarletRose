@extends('schems.topPanelSchema')

@section('title')
    Добавить картину
@endsection

@section('content')
    <form action="{{ route('adderPicture') }}" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-2 mt-1 g-3 justify-content-center">
                <div class="col-1" style="max-width: 25rem; min-width:23rem;">
                    <div class="card p-4">
                        @csrf
                        <h3>Добавить картину</h3>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Фото</label>
                            <input @if ($isFull) disabled @endif class="form-control" type="file" id="formFile"
                                accept="image/png, image/jpeg, image/jpg" name="uploadPicture" onchange="loadFile(event)">
                            @error('uploadPicture')
                                <br><a>{{ $message }}</a>
                            @enderror
                        </div>

                        <label for="namePicture">Название</label><br>
                        <textarea @if ($isFull) disabled @endif name="namePicture" style="width: 100%; max-height: 65px" cols="1" rows="3"></textarea>
                        @error('namePicture')
                            <br><a>{{ $message }}</a>
                        @enderror

                        <div class="col text-center">
                            <!-- Button trigger modal -->
                            <button @if ($isFull) disabled @endif type="button" class="btn btn-outline-success mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#techniqueWindow">
                                Выбрать технику
                            </button>
                            <!-- Button trigger modal -->
                            <button @if ($isFull) disabled @endif type="button" class="btn btn-outline-info mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#exhibitionWindow">
                                Выбрать выставку
                            </button>
                        </div>

                        <table>
                            <tr>
                                <td>
                                    <label>Высота<br>
                                        <input @if ($isFull) disabled @endif name="height" style="width: 80%">см</label>
                                    @error('height')
                                        <a>{{ $message }}</a>
                                    @enderror
                                </td>
                                <td>
                                    <label>Ширина<br>
                                        <input @if ($isFull) disabled @endif name="width" style="width: 80%">см</label>
                                    @error('width')
                                        <a>{{ $message }}</a>
                                    @enderror
                                </td>
                            </tr>

                        </table>


                        <label>О картине</label><br>
                        <textarea @if ($isFull) disabled @endif name="aboutPicture" style="width: 100%; height:100px; max-height: 300px" cols="1" rows="10"></textarea>
                        @error('aboutPicture')
                            <a>{{ $message }}</a>
                        @enderror


                        @error('price')
                            <br><a>{{ __($message) }}</a>
                        @enderror

                        @error('exhibitions')
                            <br><a>{{ $message }}</a>
                        @enderror

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input @if ($isFull) disabled @endif class="btn btn-primary mt-3" type="submit">
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

        .noselect {
            -webkit-touch-callout: none;
            /* iOS Safari */
            -webkit-user-select: none;
            /* Safari */
            -khtml-user-select: none;
            /* Konqueror HTML */
            -moz-user-select: none;
            /* Old versions of Firefox */
            -ms-user-select: none;
            /* Internet Explorer/Edge */
            user-select: none;
            /* Non-prefixed version, currently
                                                              supported by Chrome, Edge, Opera and Firefox */
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
