@extends('schems.topPanelSchema')

@section('title')
    Добавить Выставку
@endsection

@section('content')
    <div class="container card p-3 mt-4" style="max-width: 23rem;">
        <h3>Добавление Выставки</h3>
        <form action="{{ route('addingExhibition') }}">
            @csrf

            <div class="form-row">
                <div class="col mb-3">
                    <label for="validationServer03">Заголовк</label>
                    <input type="text" id="basic-addon1" placeholder="Заголовок выставки" name="title" required
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">



                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="basic-addon1">Дата начала</label>
                            <input type="date" name="start_at" id="basic-addon1"
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
                            <input type="date" name="end_at" id="basic-addon1"
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
                        class="form-control @error('about') is-invalid @enderror"></textarea>
                    @error('about')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <button type="submit" style="width: 35%" class="btn btn-success">Добавить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
