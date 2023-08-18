@extends('schems.topPanelSchema')

@section('title')
Добавить картину
@endsection

@section('content')
<div class="mainPanel">
    <div class="data">
        <form action="{{route('adderPicture')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label>Фото</label>
                <br>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="uploadPicture" onchange="loadFile(event)">
                @error('uploadPicture')
                <br><a>{{$message}}</a>
                @enderror
            </div>

            <div>
                <label>Название</label>
                <br>
                <textarea name="namePicture" id="namePicture" class="textInput" cols="1" rows="10"></textarea>
                @error('namePicture')
                <br><a>{{$message}}</a>
                @enderror
            </div>

            <div>

                @foreach ($categories as $category)

                    @if (!DB::table('under_categories')->where('category_id', '=', $category->id)->get()->first())
                        <label for="{{$category->id}} {{$category->name}}">---{{$category->name}}---</label>
                        <input type="checkbox" name="technique, {{$category->id}},{{$category->id}}"><br>
                    @else
                    <label for="{{$category->id}} {{$category->name}}">------{{$category->name}}------</label><br>
                    @endif

                    @foreach (DB::table('under_categories')->where('category_id', '=', $category->id)->get() as $item)

                        <label for="{{$category->name}} {{$item->name}}">{{$item->name}}</label>
                        <input type="checkbox" id="{{$category->name}}" name="technique,{{$category->id}},{{$item->id}}" onclick="onlyOne(this, '{{$category->name}}')"><br>

                    @endforeach

                @endforeach

                <label for="На продажу">---На продажу---</label>
                <input type="checkbox" onclick="var input = document.getElementById('price'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}"><br>
            </div>

            <div>
                <label>О картине</label>
                <br>
                <textarea name="aboutPicture" id="aboutPicture" class="textInput" cols="1" rows="10"></textarea>
                @error('aboutPicture')
                <a>{{$message}}</a>
                @enderror
            </div>


            <div>
                <input disabled name="price" id="price" class="textInput">&#8381;
                @error('price')
                <br><a>{{$message}}</a>
                @enderror
            </div>

            <div>
                <input id="inputButton" type="submit">
            </div>
        </form>
    </div>

    <div id="filePreviewBlockId" class="previewImageBlock">
        <img id="filePreview">
    </div>
</div>
@endsection

<script>
var loadFile = function (event) {
    var output = document.getElementById("filePreview");
    var div = document.getElementById('filePreviewBlockId');

    var widthDiv = div.getAttribute('style', 'width');
    var heightDiv = div.getAttribute('height');

    output.src = URL.createObjectURL(event.target.files[0]);

    output.onload = function () {
        URL.revokeObjectURL(output.src);
    };
};


var onlyOne = function (checkbox, checkboxNameId) {

    var checkboxes = document.querySelectorAll('[id="' + checkboxNameId + '"]');

    checkboxes.forEach(element => {
        if (element !== checkbox)
            element.checked = false;
    });
};


</script>
