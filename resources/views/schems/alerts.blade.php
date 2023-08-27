@if (Session::has('status'))
    <div class="alert alert-{{ $alterStatus }}">
        {{ Session::get('status') }}
    </div>
@endif
