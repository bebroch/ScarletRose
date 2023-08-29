@extends('schems.topPanelSchema')

@section('title')
    Добавить Афишу
@endsection

@section('content')
    <div class="container card p-3 mt-4" style="max-width: 23rem;">
        <h3>Добавление афиши</h3>
        <form action="{{ route('createPoster_process') }}">
            @csrf

            <div class="form-row">
                <div class="col mb-3">
                    <label for="validationServer03">Заголовк</label>
                    <input type="text" id="basic-addon1" placeholder="Заголовок афиши" name="title" required
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <label class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        role="tab" aria-controls="pills-home" aria-selected="true">
                        <input style="appearance: none;" type="radio" name="dayOrSpanDays" value="day" checked>
                        Один
                        день
                    </label>
                </li>
                <li class="nav-item" role="presentation">
                    <label class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        role="tab" aria-controls="pills-profile" aria-selected="false">
                        <input style="appearance: none;" type="radio" name="dayOrSpanDays" value="spanDays">
                        Промежуток
                    </label>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="basic-addon1">Дата проведения</label>
                            <input type="date" name="date" id="basic-addon1"
                                class="form-control @error('date') is-invalid @enderror">
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ trans($message) }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">



                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="basic-addon1">Дата начала</label>
                            <input type="date" name="dateStart" id="basic-addon1"
                                class="form-control @error('dateStart') is-invalid @enderror">
                            @error('dateStart')
                                <div class="invalid-feedback">
                                    {{ trans($message) }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="basic-addon1">Дата окончания</label>
                            <input type="date" name="dateEnd" id="basic-addon1"
                                class="form-control @error('dateEnd') is-invalid @enderror">
                            @error('dateEnd')
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
                    <label for="validationServer03">Место проведения</label>
                    <input type="text" id="basic-addon1" placeholder="Место проведения афиши" name="location"
                        class="form-control @error('location') is-invalid @enderror">
                    @error('location')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>



            <div class="form-row">
                <div class="col mb-3">
                    <label for="validationServer03">Текст афиши</label>
                    <textarea type="text" id="basic-addon1" placeholder="О чём будет афиша" name="about" required
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
