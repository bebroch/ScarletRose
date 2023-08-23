@extends('schems.topPanelSchema')

@section('title')
    Редактировать картину
@endsection

@section('content')
    <div class="container mt-4" style="width: 30em;">
        <form action="">
            @csrf
            <div class="card m-5">
                <div class="row g-0">
                    <div class="col-md">
                        <div class="form-row">
                            <div class="col mb-3">
                                <label for="validationServer03">Заголовк</label>
                                <input type="text" id="basic-addon1" placeholder="Заголовок афиши" name="title" required
                                    class="form-control @error('title') is-invalid @enderror">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
