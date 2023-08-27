@extends('schems.topPanelSchema')

@section('title')
    Добавить Новость
@endsection

@section('content')

    <div class="container card p-3 mt-4" style="max-width: 23rem;">
        <h3>Добавление Новости</h3>
        <form action="{{ route('addingNew') }}">
            @csrf

            <div class="form-row">
                <div class="col mb-3">
                    <label for="validationServer03">Заголовк</label>
                    <input type="text" id="basic-addon1" placeholder="Заголовок Новости" name="title" required
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>



            <div class="form-row">
                <div class="col mb-3">
                    <label for="validationServer03">Текст Новости</label>
                    <textarea style="height: 20vh" type="text" id="basic-addon1" placeholder="О чём будет новость" name="about" required
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
                        <button type="submit" style="width: 30%" class="btn btn-success">Добавить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
