@extends('schems.topPanelSchema')

@section('title')
{{$image->name}}
@endsection

@section('content')

<div style="margin: 40px">
    <img style="float: left" width="400" src="{{Storage::url("$image->imagePath")}}">
    <div>
        <h1>{{$image->name}}</h1>
        <h3><a href="{{ route("userProfile", ['id' => $user->id], false) }}">{{$user->login}}</a></h3>
        @if (DB::table('under_categories_pictures')->where('picture_id', '=', $image->id)->get()->first())
            <h3>Категории:
        @endif
        @foreach (DB::table('under_categories_pictures')->where('picture_id', '=', $image->id)->get() as $category)
            {{DB::table('under_categories')->find($category->under_category_id )->name}},
        @endforeach
        <h3>О картине:</h3>
        <h4>{{$image->about}}</h4>
        @if ($image->price)
            <h4>Стоимость: {{$image->price}}&#8381;</h4>
        @endif
        @auth('web')
            @if (Auth::user()->is_admin)
                <form action="{{route('deletePicture')}}">
                    <input type="text" hidden value="{{$image->id}}" name="image">
                    <input type="submit" value="Удалить картину">
                </form>
            @endif
        @endauth
    </div>
</div>


<!-- Кнопка-триггер модального окна -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Запустить модальное окно со статическим фоном
  </button>

  <!-- Модальное окно -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Заголовок модального окна</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          <button type="button" class="btn btn-primary">Понял</button>
        </div>
      </div>
    </div>
  </div>



@endsection
