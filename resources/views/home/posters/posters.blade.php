@extends('schems.topPanelSchema')

@section('title')
    Афиши
@endsection

@section('content')
    <div class="container mt-3">
        <div class="card-header mb-3">

            @include('schems.topName', ['name' => "Афиша"])
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-future"
                        type="button" role="tab" aria-controls="v-pills-future" aria-selected="false">Будущие</button>
                </li>
                <li class="nav-item ms-2">
                    <button class="nav-link active" id="v-pills-active-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-active" type="button" role="tab" aria-controls="v-pills-active"
                        aria-selected="true">Активные</button>
                </li>
                <li class="nav-item ms-2">
                    <button class="nav-link" id="v-pills-passive-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-passive" type="button" role="tab" aria-controls="v-pills-passive"
                        aria-selected="false">Прошедшие</button>
                </li>
            </ul>
        </div>


        <div class="tab-content" id="v-pills-tabContent" style="width:100%">
            <div class="tab-pane fade" id="v-pills-future" role="tabpanel" aria-labelledby="v-pills-future-tab">

                <div class="row row-cols-1 row-cols-md-2 mb-2">
                    @foreach ($postersF as $poster)
                        <div class="card-deck mt-2">
                            <div class="card">
                                <a href="{{ route('posters') }}/{{ $poster->id }}" class="nav-link">
                                    <div class="card-body">
                                        <h3 class="card-title" style="font-weight: bold">{{ $poster->name }}</h3>
                                        <p class="card-text">
                                        <h5>{{ $poster->about }}</h5>
                                        </p>
                                        <button class="btn btn-primary">Смотреть</button>
                                    </div>
                                </a>
                                <div class="card-footer">
                                    <small class="text-muted">
                                        @if (!empty($poster->date))
                                            Афиша начнётся
                                            {{ Carbon\Carbon::parse($poster->timeEventStart)->diffForHumans() }}
                                        @else
                                            Афиша начнётся
                                            {{ Carbon\Carbon::parse($poster->timeEventDay)->diffForHumans() }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="tab-pane fade show active" id="v-pills-active" role="tabpanel" aria-labelledby="v-pills-active-tab">

                <div class="row row-cols-1 row-cols-md-2">
                    @foreach ($postersA as $poster)
                        <div class="card-deck mt-2">
                            <div class="card">
                                <a href="{{ route('posters') }}/{{ $poster->id }}" class="nav-link">
                                    <div class="card-body">
                                        <h3 class="card-title" style="font-weight: bold">{{ $poster->name }}</h3>
                                        <p class="card-text">
                                        <h5>{{ $poster->about }}</h5>
                                        </p>
                                        <button class="btn btn-primary">Смотреть</button>
                                    </div>
                                </a>
                                <div class="card-footer">
                                    <small class="text-muted">
                                        @if (!empty($poster->timeEventStart))
                                            Афиша началась
                                            {{ Carbon\Carbon::parse($poster->timeEventStart)->diffForHumans() }}
                                        @elseif (!empty($poster->timeEventDay))
                                            Афиша началась
                                            {{ Carbon\Carbon::parse($poster->timeEventDay)->diffForHumans() }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="tab-pane fade" id="v-pills-passive" role="tabpanel" aria-labelledby="v-pills-passive-tab">
                <div class="row row-cols-1 row-cols-md-2">
                    @foreach ($postersP as $poster)
                        <div class="card-deck mt-2">
                            <div class="card">
                                <a href="{{ route('posters') }}/{{ $poster->id }}" class="nav-link">
                                    <div class="card-body">
                                        <h3 class="card-title" style="font-weight: bold">{{ $poster->name }}</h3>
                                        <p class="card-text">
                                        <h5>{{ $poster->about }}</h5>
                                        </p>
                                        <button class="btn btn-primary">Смотреть</button>
                                    </div>
                                </a>
                                <div class="card-footer">
                                    <small class="text-muted">
                                        @if (!empty($poster->timeEventEnd))
                                            Афиша закончилась
                                            {{ Carbon\Carbon::parse($poster->timeEventEnd)->diffForHumans() }}
                                        @elseif (!empty($poster->timeEventDay))
                                            Афиша закончилась
                                            {{ Carbon\Carbon::parse($poster->timeEventDay)->diffForHumans() }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
