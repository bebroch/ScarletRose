@extends('schems.topPanelSchema')

@section('title')
Изменить информацию
@endsection

@section('content')

<div class="container mt-5">
    <div class="card p-3 pt-0 pb-0 mx-auto" style="max-width: 27rem;">
        <div class="text-center pt-3" style="">
            <h3>Изменить информацию</h3>
        </div>

        <form action="{{route('updateInfo_process')}}" method="GET">
            @csrf
            <div class="input-group mb-3 mt-2">
                <label class="input-group-text" for="inputGroupSelect01">Логин</label>
                <input name="login" value="{{Auth::user()->login}}" placeholder="Введите логин" type="text" aria-label="First name" class="form-control">
            </div>
            <div class="input-group mb-3 mt-3">
                <label class="input-group-text" for="inputGroupSelect01">Имя</label>
                <input name="firstname" value="{{Auth::user()->firstname}}" placeholder="Введите имя" type="text" aria-label="First name" class="form-control">
            </div>
            <div class="input-group mb-3 mt-3">
                <label class="input-group-text" for="inputGroupSelect01">Фамилия</label>
                <input name="lastname" value="{{Auth::user()->lastname}}" placeholder="Введите фамилию" type="text" aria-label="First name" class="form-control">
            </div>
            <div class="input-group mb-3 mt-3">
                <label class="input-group-text" for="inputGroupSelect01">Телефон</label>
                <input name="phone" value="{{Auth::user()->phone}}" placeholder="Введите номер телефона" type="text" aria-label="First name" class="form-control">
            </div>
            <div class="input-group mb-3 mt-3">
                <label class="input-group-text" for="inputGroupSelect01">О себе</label>
                <textarea type="text" name="about" class="form-control" placeholder="О себе" aria-label="Recipient's username" aria-describedby="button-addon2">{{Auth::user()->about}}</textarea>
            </div>


            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-outline-secondary mb-3" type="submit" id="button-addon2">Изменить</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
