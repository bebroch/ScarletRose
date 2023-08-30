@extends('schems.topPanelSchema')

@section('title')
    Изменить выставку
@endsection

@section('content')
    <div class="container card p-3 mt-4" style="max-width: 23rem;">
        <h3>Изменение Выставки</h3>
        <form action="{{ route('editExhibition_process', ['id' => $exhibition->id]) }}">
            @csrf
            <input type="text" value="{{ $exhibition->id }}" hidden name="id">
            <div class="form-row">
                <div class="col mb-3">
                    <label for="validationServer03">Заголовк</label>
                    <input type="text" id="basic-addon1" placeholder="Заголовок выставки" value="{{ $exhibition->title }}"
                        name="title" required class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                    aria-labelledby="pills-profile-tab">



                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="basic-addon1">Дата начала</label>
                            <input value="{{ $exhibition->start_at }}" value="{{ $exhibition->title }}" type="date"
                                name="start_at" id="basic-addon1"
                                class="form-control @error('start_at') is-invalid @enderror">
                            @error('start_at')
                                <div class="invalid-feedback">
                                    {{ trans($message) }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="basic-addon1">Дата окончания</label>
                            <input value="{{ $exhibition->end_at }}" type="date" name="end_at" id="basic-addon1"
                                class="form-control @error('end_at') is-invalid @enderror">
                            @error('end_at')
                                <div class="invalid-feedback">
                                    {{ trans($message) }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-row">
                <div class="col mb-3">
                    <label for="validationServer03">Текст выставки</label>
                    <textarea type="text" id="basic-addon1" placeholder="О чём будет выставка" name="about" required
                        class="form-control @error('about') is-invalid @enderror">{{ $exhibition->about }}</textarea>
                    @error('about')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="col d-flex justify-content-around">
                    <button type="submit" style="width: 46%" class="btn btn-warning">Обновить запись</button>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#{{ $exhibition->id }}">
                        Удалить картину
                    </button>
                </div>
            </div>
        </form>
    </div>

    @include('schems.deleteItemModalWindow', [
        'item' => $exhibition,
        'route' => 'deleteExhibition_process',
        'nameShape1' => 'выставки',
        'nameShape2' => 'выставку',
    ])
@endsection
