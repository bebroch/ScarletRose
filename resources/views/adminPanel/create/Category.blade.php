@extends('schems.topPanelSchema')

@section('title')
    Категории
@endsection

@section('content')
    <div class="mt-3">
        @include('schems.topName', ['name' => 'Категории'])
    </div>
    <div class="card container mt-3 p-3">
        <div class="row">
            <div class="col-md border-end">
                <form action="{{ route('addCategory_process') }}">
                    <h4>Создать категорию</h4>
                    <div class="input-group mb-3">
                        <input type="text" name="Category" class="form-control @error('Category') is-invalid @enderror"
                            placeholder="Название категории" aria-label="Recipient's username"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Добавить</button>
                        </div>
                    </div>
                </form>
                @error('Category')
                    {{ $message }}
                @enderror


                <h4>Создать подкатегорию</h4>
                <form action="{{ route('addUnderCategory_process') }}">
                    <label for="text" id="lbl">Выберите категорию</label>
                    <input hidden id="inp" type="category" name="category_for_underCategory">
                    <div class="input-group mb-3">
                        <input type="text" name="underCategory"
                            class="form-control @error('underCategory') is-invalid @enderror"
                            placeholder="Название подкатегории" aria-label="Recipient's username"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Добавить</button>
                        </div>
                    </div>
                </form>
                @error('underCategory')
                    {{ $message }}
                @enderror

                <h4>Удалить категорию</h4>
                <div class="input-group mb-3">
                    <form action="{{ route('deleteCategory_process') }}" style="width: 100%">
                        <div class="btn-group" role="group" style="width: 100%">
                            <select name="category" class="form-select" aria-label="Default select example">
                                <option selected>Выберите категорию</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger" type="submit">Удалить</button>
                            </div>
                        </div>
                    </form>
                </div>
                @error('underCategory')
                    {{ $message }}
                @enderror

                <h4>Удалить подкатегорию</h4>
                <div class="input-group mb-3">
                    <form action="{{ route('deleteUnderCategory_process') }}" style="width: 100%">
                        <div class="btn-group" role="group" style="width: 100%">
                            <select name="under_category" class="form-select" aria-label="Default select example">
                                <option selected>Выберите подкатегорию</option>
                                @foreach (DB::table('under_categories')->get() as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <input class="btn btn-outline-danger" type="submit" value="Удалить">
                            </div>
                        </div>

                    </form>
                </div>
                @error('underCategory')
                    {{ $message }}
                @enderror



            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col g-3">
                            <ul class="list-group">
                                <li class="list-group" aria-current="true">
                                    <button class="btn btn-outline-info" style="width: 100%"
                                        onclick="selection('{{ $category->name }}')">{{ $category->name }}</button>
                                </li>
                                @foreach (DB::table('under_categories')->where('category_id', '=', $category->id)->get() as $item)
                                    <li class="list-group-item" style="width: 100%">{{ $item->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>





    {{--



    <div class="container">
        <h4>Создать категорию</h4>
        <form action="{{ route('addingCategory') }}">
            @csrf
            <input tabindex="1" placeholder="Имя категории" type="text" name="nameCategory"><br>
            @error('nameCategory')
                {{ $message }}
            @enderror
            <input type="submit">
        </form>
        <h4>Создать подкатегорию</h4>
        <form action="{{ route('addingUnderCategory') }}">
            @csrf
            <label for="text" id="lbl">--Выберите категорию--</label>
            @error('category')
                {{ $message }}
            @enderror
            <input hidden id="inp" type="category" name="category" value=""><br>
            <input tabindex="2" placeholder="Имя категории" type="text" name="nameUnderCategory"><br>
            @error('nameUnderCategory')
                {{ $message }}
            @enderror
            <input type="submit">
        </form>

        <h4>Удалить Категорию</h4>
        <form action="{{ route('deleteCategory') }}">
            <select name="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="submit" value="Удалить">
        </form>

        <h4>Удалить подКатегорию</h4>
        <form action="{{ route('deleteUnderCategory') }}">
            <select name="under_category">
                @foreach (DB::table('under_categories')->get() as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="submit" value="Удалить">
        </form>

        <h3>Существующие категории</h3>
        <ul>
            @foreach ($categories as $category)
                <li>
                    <button class="btn btn-outline-info"
                        onclick="selection('{{ $category->name }}')">{{ $category->name }}</button>
                    <ul>
                        @foreach (DB::table('under_categories')->where('category_id', '=', $category->id)->get() as $item)
                            <li>{{ $item->name }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div> --}}

    <script>
        function selection(name) {
            document.getElementById('inp').value = name;
            document.getElementById('lbl').innerHTML = name;
        }
    </script>
@endsection
