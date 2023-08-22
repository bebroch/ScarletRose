@extends('schems.topPanelSchema')

@section('title')
    {{ $image->name }}
@endsection

@section('content')
    <div style="margin: 40px">
        <img style="float: left" width="400" src="{{ Storage::url("$image->imagePath") }}">
        <div>
            <!-- Имя картины -->
            <h1>{{ $image->name }}</h1>

            <!-- Кто нарисовал -->
            <h3><a href="{{ route('userProfile', ['id' => $user->id], false) }}">{{ $user->login }}</a></h3>

            <!-- Участвует в выставках -->
            @if (DB::table('exhibitions_pictures')->where('picture_id', '=', $image->id)->get()->first())
                <h3>Участие в выставках:
            @endif
            @foreach (DB::table('exhibitions_pictures')->where('picture_id', '=', $image->id)->get() as $exhibition)
                <li>
                    <a href="{{ route('exhibition', ['id' => $exhibition->exhibition_id]) }}">
                        {{ DB::table('exhibitions')->find($exhibition->exhibition_id)->title }}
                    </a>
                </li>
            @endforeach

            <!-- Категории -->
            @if (DB::table('under_categories_pictures')->where('picture_id', '=', $image->id)->get()->first())
                <h3>Категории:
            @endif
            @foreach (DB::table('under_categories_pictures')->where('picture_id', '=', $image->id)->get() as $category)
                <li>{{ DB::table('under_categories')->find($category->under_category_id)->name }}</li>
            @endforeach

            <!-- О картине -->
            <h3>О картине:</h3>
            <h4>{{ $image->about }}</h4>

            <!-- Стоимость -->
            @if ($image->price)
                <h4>Стоимость: {{ $image->price }}&#8381;</h4>
            @endif

            <!-- Удалить картину -->
            @auth('web')
                @if (Auth::user()->is_admin)
                    <!-- Кнопка-триггер модального окна -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Удалить картину
                    </button>
                @endif
            @endauth
        </div>
    </div>


    @auth('web')
        @if (Auth::user()->is_admin)
            <!-- Модальное окно -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Удаление картины</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            Вы действительно хотите удалить - {{ $image->name }}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <form action="{{ route('deletePicture') }}">
                                <input type="text" hidden value="{{ $image->id }}" name="image">
                                <input class="btn btn-danger" type="submit" value="Удалить картину">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection
