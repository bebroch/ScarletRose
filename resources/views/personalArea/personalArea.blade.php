@extends('schems.topPanelSchema')

@section('title')
Личный кабинет
@endsection

@section('content')
<div class="mainPanel">
    <ul>
        <li class="personData text">
            <div class="personImage"></div>
            <a>
                {{Auth::user()->login}}
            </a>
            <div class="firstLastName">
                <a>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</a>
            </div>
        </li>

        <li class="about">
            <p>{{Auth::user()->about}}</p>
        </li>
    </ul>

    <div class="settingsWindow">
        <div class="settingWindow text">
            <a href="{{route('myPictures')}}">Мои картины</a>
            <div class="myPictures"></div>
        </div>

        <div class="settingWindow text">
            <a href="{{route('addPicture')}}">Добавить картину</a>
            <div class="addingPicture"></div>
        </div>

        <div class="settingWindow text">
            <a href="{{route('updateInformation')}}">Изменить инофрмацию</a>
            <div class="updateInformation"></div>
        </div>
    </div>
</div>
@endsection
