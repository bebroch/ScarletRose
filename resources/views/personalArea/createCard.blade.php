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

            <!--
            <div>
                <label>Техника написания</label>
                <br>
                <textarea name="technique" id="techniquePicture" class="textInput" cols="1" rows="10"></textarea>
                @error('technique')
                <br><a>{{$message}}</a>
                @enderror
            </div>
            -->

            <div>
                <select name="technique">
                    <option>-- Выберите Категорию --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('technique')
                <br><a>{{$message}}</a>
                @enderror
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
    /*
    output.onload = function () {
        URL.revokeObjectURL(output.src);
    };*/
};
</script>
