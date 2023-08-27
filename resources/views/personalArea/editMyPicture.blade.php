@extends('schems.topPanelSchema')

@section('title')
    Редактировать картину
@endsection

@section('content')
    <form action="{{ route('editMyPicture_process') }}" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-md-2 mt-1 g-3 justify-content-center">
                <div class="col-1" style="max-width: 25rem; min-width:23rem;">
                    <div class="card p-4">
                        @csrf
                        <input hidden type="text" name="id" value="{{$picture->id}}">

                        <h3>Редактировать картину</h3>

                        <label for="namePicture">Название</label><br>
                        <textarea disabled name="namePicture" style="width: 100%; max-height: 65px" cols="1" rows="3">{{ $picture->name }}</textarea>

                        <div class="col text-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#techniqueWindow">
                                Изменить/Добавить цену
                            </button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-info mt-3 mb-2" data-bs-toggle="modal"
                                data-bs-target="#exhibitionWindow">
                                Выбрать выставку
                            </button>
                        </div>

                        <table>
                            <tr>
                                <td>
                                    <label>Высота<br>
                                        <input disabled name="height" style="width: 80%" value="{{ $picture->width }}">см</label>
                                    @error('height')
                                        <a>{{ $message }}</a>
                                    @enderror
                                </td>
                                <td>
                                    <label>Ширина<br>
                                        <input disabled name="width" style="width: 80%" value="{{ $picture->height }}">см</label>
                                    @error('width')
                                        <a>{{ $message }}</a>
                                    @enderror
                                </td>
                            </tr>

                        </table>


                        <label>О картине</label><br>
                        <textarea disabled name="aboutPicture" style="width: 100%; height:100px; max-height: 300px" cols="1" rows="10">{{ $picture->about }}</textarea>
                        @error('aboutPicture')
                            <a>{{ $message }}</a>
                        @enderror


                        @error('price')
                            <br><a>{{ $message }}</a>
                        @enderror

                        @error('exhibitions')
                            <br><a>{{ $message }}</a>
                        @enderror

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input class="btn btn-warning mt-3" type="submit" value="Редактировать">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center" id="filePreviewBlockId">
                            <img src="{{ Storage::url("$picture->imagePath") }}" style="max-width: 100%; max-height: 80vh">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="techniqueWindow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Изменить/Добавить цену</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                    <div class="text-center">
                        <label style="font-size: 18px; font-weight:bold">
                            <input type="checkbox" name="checkPrice"
                                onclick="var input = document.getElementById('price'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}">
                            На продажу
                        </label>
                        <input disabled name="price" id="price">
                        <label for="price">&#8381;</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Добавить</button>
            </div>
        </div>
    </div>
</div>



        <!-- Модальное окно -->
        @include('schems.modalWindowExhibitions', ['picture_id' => $picture->id, 'pressCheck' => true])
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

