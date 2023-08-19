@extends('schems.topPanelSchema')

@section('title')
Вход
@endsection


@section('content')

<div class="restOfItWindow">
    <div id="registrationWindow">
        <form class="addHeightTable" action="{{route('login_process')}}" method="POST">
            @csrf
            <table class="registrationFields" cellspacing="0" cellpadding="0">
                <tr>
                    <td id="reduceSize">
                        <p id="bigText">Вход</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="@error('login') borderRed @enderror" type="text" name="login" placeholder="Логин">
                        @error('login')
                            <p>{{$message}}</p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="registrationFields">
                        <input class="@error('password') borderRed @enderror" type="password" name="password" placeholder="Пароль">
                        @error('password')
                            <p>{{$message}}</p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="registrationFields">
                        <input id="bigButton" type="submit" name="request" value="Войти">
                    </td>
                </tr>
                <tr>
                    <td class="registrationFields">
                        <a href="{{route('register')}}">Зарегистрироваться</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

@endsection



