@extends('schems.topPanelSchema')

@section('title')
    Выставка
@endsection

@section('content')
    <div class="container mt-3">
        <div class="card-header mb-3">
            <div class="card-header">
                @include('schems.topName', ['name' => "Выставки"])
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-future" type="button" role="tab" aria-controls="v-pills-future"
                            aria-selected="false">Будущие</button>
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

                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($exhibitionsFuture as $exhibition)
                            <div class="col mt-3">
                                <div class="card">
                                    <a class="nav-link" href="{{ route('exhibition', ['id' => $exhibition->id]) }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $exhibition->title }}</h5>
                                            <p class="card-text">{{ $exhibition->about }}</p>
                                        </div>
                                    </a>
                                    <div class="card-footer bg-transparent border-success">
                                        {{ Carbon\Carbon::parse($exhibition->start_at)->isoFormat('D MMMM YYYY года') }}
                                        -
                                        {{ Carbon\Carbon::parse($exhibition->end_at)->isoFormat('D MMMM YYYY года') }}
                                    </div>
                                    @auth('web')
                                        @if (Auth::user()->is_admin)
                                            <div class="card-footer">
                                                <a class="btn btn-warning"
                                                    href="{{ route('editExhibition', ['id' => $exhibition->id]) }}">Редактировать
                                                    запись</a>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="tab-pane fade show active" id="v-pills-active" role="tabpanel"
                    aria-labelledby="v-pills-active-tab">

                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($exhibitionsActive as $exhibition)
                            <div class="col mt-3">
                                <div class="card">
                                    <a class="nav-link" href="{{ route('exhibition', ['id' => $exhibition->id]) }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $exhibition->title }}</h5>
                                            <p class="card-text">{{ $exhibition->about }}</p>
                                        </div>
                                    </a>
                                    <div class="card-footer bg-transparent border-success">
                                        {{ Carbon\Carbon::parse($exhibition->start_at)->isoFormat('D MMMM YYYY года') }}
                                        -
                                        {{ Carbon\Carbon::parse($exhibition->end_at)->isoFormat('D MMMM YYYY года') }}
                                    </div>
                                    @auth('web')
                                        @if (Auth::user()->is_admin)
                                            <div class="card-footer">
                                                <a class="btn btn-warning"
                                                    href="{{ route('editExhibition', ['id' => $exhibition->id]) }}">Редактировать
                                                    запись</a>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="tab-pane fade" id="v-pills-passive" role="tabpanel" aria-labelledby="v-pills-passive-tab">
                    <div class="row row-cols-1 row-cols-md-3">
                        @foreach ($exhibitionsPassive as $exhibition)
                            <div class="col mt-3">
                                <div class="card">
                                    <a class="nav-link" href="{{ route('exhibition', ['id' => $exhibition->id]) }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $exhibition->title }}</h5>
                                            <p class="card-text">{{ $exhibition->about }}</p>
                                        </div>
                                    </a>
                                    <div class="card-footer bg-transparent border-success">
                                        {{ Carbon\Carbon::parse($exhibition->start_at)->isoFormat('D MMMM YYYY года') }}
                                        -
                                        {{ Carbon\Carbon::parse($exhibition->end_at)->isoFormat('D MMMM YYYY года') }}
                                    </div>
                                    @auth('web')
                                        @if (Auth::user()->is_admin)
                                            <div class="card-footer">
                                                <a class="btn btn-warning"
                                                    href="{{ route('editExhibition', ['id' => $exhibition->id]) }}">Редактировать
                                                    запись</a>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endsection
