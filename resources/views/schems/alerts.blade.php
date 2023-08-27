@if (Session::has('status'))
    <div class="alert alert-success">
        {{ Session::get('status') }}
    </div>
@endif
