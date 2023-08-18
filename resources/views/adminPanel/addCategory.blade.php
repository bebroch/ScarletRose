@extends('schems.topPanelSchema')

@section('title')
Добавить Новость
@endsection

@section('content')

<div class="container">
    <h4>Создать категорию</h4>
    <form action="{{route('addingCategory')}}">
        @csrf
        <input tabindex="1" placeholder="Имя категории" type="text" name="nameCategory"><br>
        @error('nameCategory')
            {{$message}}
        @enderror
        <input type="submit">
    </form>
    <h4>Создать под-категорию</h4>
    <form action="{{route('addingUnderCategory')}}">
        @csrf
        <label for="text" id="lbl">--Выберите категорию--</label>
        @error('category')
            {{$message}}
        @enderror
        <input hidden id="inp" type="category" name="category" value=""><br>
        <input tabindex="2" placeholder="Имя категории" type="text" name="nameUnderCategory"><br>
        @error('nameUnderCategory')
            {{$message}}
        @enderror
        <input type="submit">
    </form>

    <h4>Удалить Категорию</h4>
    <form action="{{route('deleteCategory')}}">
        <select name="category">
            @foreach ($categories as $category)
                <option value="{{$category->name}}">{{$category->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="Удалить">
    </form>

    <h4>Удалить под-Категорию</h4>
    <form action="{{route('deleteUnderCategory')}}">
        <select name="under_category">
            @foreach (DB::table('under_categories')->get() as $category)
                <option value="{{$category->name}}">{{$category->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="Удалить">
    </form>

    <h3>Существующие категории</h3>
    <ul>
        @foreach ($categories as $category)
            <li>
                <button class="btn btn-outline-info" onclick="selection('{{$category->name}}')">{{$category->name}}</button>
                <ul>
                    @foreach (DB::table('under_categories')
                    ->where('category_id', '=', $category->id)
                    ->get() as $item)

                        <li>{{$item->name}}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>

<script>
    function selection(name){
        document.getElementById('inp').value = name;
        document.getElementById('lbl').innerHTML = name;
    }

</script>

@endsection
