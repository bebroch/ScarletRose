@extends('schems.topPanelSchema')

@section('title')
Регистрация
@endsection

@section('content')

<div class="restOfItWindow">
    <div id="registrationWindow">
        <form class="addHeightTable" action="{{route('register_process')}}" method="POST">
            @csrf
            <table class="registrationFields" cellspacing="0" cellpadding="0">
                <tr>
                    <td id="reduceSize">
                        <p id="bigText">Регистрация</p>
                    </td>

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
                        <input class="@error('password') borderRed @enderror" type="text" name="password" placeholder="Пароль">
                        @error('password')
                            <p>{{$message}}</p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="registrationFields">
                        <input class="@error('password_confirmation') borderRed @enderror" type="text" name="password_confirmation" placeholder="Подтвердите пароль">
                        @error('password_confirmation')
                            <p>{{$message}}</p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="registrationFields">
                        <input class="@error('email') borderRed @enderror" type="text" name="email" placeholder="Адрес электронной почты">
                        @error('email')
                            <p>{{$message}}</p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="registrationFields">
                        <input id="bigButton" type="submit" name="request" value="Зарегистрироваться">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

@endsection



