@extends('schems.topPanelSchema')

@section('title')
    Выставка
@endsection

@section('content')
    <div class="container mt-3 mb-3">
        <div class="card-header mb-3">
            <div class="card-header">
                @include('schems.topName', ['name' => 'Выставка'])
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
                @include('schems.exhibitions.exhibitionsByTime', ['exhibitions' => $exhibitionsFuture, 'status' => 'future'])
                @include('schems.exhibitions.exhibitionsByTime', ['exhibitions' => $exhibitionsActive, 'status' => 'active'])
                @include('schems.exhibitions.exhibitionsByTime', ['exhibitions' => $exhibitionsPassive, 'status' => 'passive'])
            </div>
        </div>
    </div>
@endsection
