@extends('schems.topPanelSchema')

@section('title')
    {{ $image->name }}
@endsection



@section('content')
    <div class="container-fliud card mt-4" style="margin-inline: 5%;">
        <div class="row g-0">
            <div class="col-md">
                <img src="{{ Storage::url("$image->imagePath") }}" class="img-fluid rounded-start">
            </div>
            <div class="col-md">
                <div class="card-body">
                    <!-- Имя картины -->
                    <div class="text-center">
                        <h1>{{ $image->name }}</h1>
                    </div>

                    <div class="container-fluid text-center">
                        <div class="row row-cols-1 row-cols-md-2 mt-0 g-3">

                            <!-- Кто нарисовал -->
                            <div class="col">
                                <h2 style="font-weight: bold">Автор</h2>
                                <h5><a class="link-info link-underline-opacity-0" href="{{ route('userProfile', ['id' => $user->id], false) }}">{{ $user->login }}</a>
                                </h5>

                            </div>


                            <!-- Участвует в выставках -->
                            <div class="col">


                                @if (DB::table('exhibitions_pictures')->where('picture_id', '=', $image->id)->get()->first())
                                    <h3 style="font-weight: bold">Участие в выставках:</h3>
                                @endif
                                @foreach (DB::table('exhibitions_pictures')->where('picture_id', '=', $image->id)->get() as $exhibition)
                                    <h5>
                                        <a class="link-info link-underline-opacity-0" href="{{ route('exhibition', ['id' => $exhibition->exhibition_id]) }}">
                                            {{ DB::table('exhibitions')->find($exhibition->exhibition_id)->title }}
                                        </a>
                                    </h5>
                                @endforeach

                            </div>



                            <!-- Категории -->
                            <div class="col">
                                @if ($categories)
                                    <h3 style="font-weight: bold">Теги:</h3>
                                @endif
                                <div class="container-fluid justify-content-center">
                                    <div class="row row-cols-1">
                                        @foreach ($categories as $category => $under_category)
                                            @if (!empty($category))
                                                <div class="col">
                                                    @if (!empty($under_category))
                                                        <h5><a style="font-weight: bold;">{{ $category }}:
                                                            </a>{{ $under_category }}</h5>
                                                    @else
                                                        <h5><a style="font-weight: bold;">{{ $category }}: </a></h5>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>



                            <!-- Размер -->
                            <div class="col-lg">
                                <h3 style="font-weight: bold">Размеры</h3>
                                <h5><a style="font-weight: bold">Высота: </a>{{$image->height}}</h5>
                                <h5><a style="font-weight: bold">Ширина: </a>{{$image->width}}</h5>

                            </div>
                        </div>
                    </div>


                    <!-- О картине -->
                    <h3 style="font-weight: bold">О картине:</h3>
                    <h3>{{ $image->about }}</h3>

                    <!-- Стоимость -->
                    @if ($image->price)
                        <h4>Стоимость: {{ $image->price }}&#8381;</h4>
                    @endif

                    <!-- Удалить картину -->
                    @auth('web')
                        @if (Auth::user()->is_admin)
                            <!-- Кнопка-триггер модального окна -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Удалить картину
                            </button>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно -->
    <div class="modal fade" id="{{ $image->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                    <a class="btn btn-danger" href="{{ route('deletePicture', ['id' => $image->id]) }}">Удалить
                        картину</a>
                </div>
            </div>
        </div>
    </div>
@endsection
