@extends('schems.topPanelSchema')

@section('title')
    Афиша
@endsection

@section('content')
    <div class="container mt-3">
        <div class="card-header mb-3">

            @include('schems.topName', ['name' => 'Афиша'])
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


        <div class="tab-content mb-3" id="v-pills-tabContent" style="width:100%">
            <!--TODO Проверить работает ли афиши -->
            @include('schems.posters.timePosterWindow', [
                'posters' => $postersF,
                'tab' => 'future',
                'posterTimeText' => 'Афиша начнётся',
            ])
            @include('schems.posters.timePosterWindow', [
                'posters' => $postersA,
                'tab' => 'active',
                'posterTimeText' => 'Афиша началась',
            ])
            @include('schems.posters.timePosterWindow', [
                'posters' => $postersP,
                'tab' => 'passive',
                'posterTimeText' => 'Афиша закончилась',
            ])

        </div>

    </div>
@endsection
