@extends('schems.topPanelSchema')

@section('title')
Изменить информацию
@endsection

@section('content')

<div class="card container mt-5" style="width: 27em; border: 1px solid black">

    <form action="{{route('updateInformation_process')}}" method="POST">
        @csrf
        <div class="input-group mb-3 mt-3">
            <input type="text" name="login" value="{{Auth::user()->login}}" class="form-control" placeholder="Логин" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Изменить</button>
        </div>
    </form>




    <form action="{{route('updateInformation_process')}}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="firstname" value="{{Auth::user()->firstname}}" class="form-control" placeholder="Имя" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Изменить</button>
        </div>
    </form>




    <form action="{{route('updateInformation_process')}}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="lastname" value="{{Auth::user()->lastname}}" class="form-control" placeholder="Фамилия" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Изменить</button>
        </div>
    </form>



    <form action="{{route('updateInformation_process')}}" method="POST">
            @csrf
        <div class="input-group mb-3">
            <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control" placeholder="Телефон (+7-012-345-67-89)" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Изменить</button>
        </div>
    </form>



    <form action="{{route('updateInformation_process')}}" method="POST">
            @csrf
        <div class="input-group mb-3">
            <textarea type="text" name="about" value="{{Auth::user()->about}}" class="form-control" placeholder="О себе" aria-label="Recipient's username" aria-describedby="button-addon2"></textarea>
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Изменить</button>
        </div>
    </form>
</div>

@endsection
