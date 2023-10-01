@if (!empty($user))
    @include('schems.profile', ['name' => $user->login])
@else
    @php
        abort(404, 'Пользователь не найден');
    @endphp
@endif
