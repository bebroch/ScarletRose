@extends('schems.topPanelSchema')

@section('title')
    {{ $image->name }}
@endsection

@section('content')
    <div class="container-fluid mt-4" style="height: 100vh;">
        <div class="row align-items-center justify-content-center">
            <!-- align-items-center добавлен для центрирования по вертикали -->
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-5" style="border: 1px solid black">
                            <img src="{{ Storage::url("$image->imagePath") }}" style=" object-fit: contain; max-height:80vh"
                                class="img-fluid rounded-start">
                        </div>
                        <div class="col-sm" style="border: 1px solid black">
                            <div class="card-body">
                                <div>
                                    <!-- Имя картины -->
                                    <h1>{{ $image->name }}</h1>

                                    <!-- Кто нарисовал -->
                                    <h3><a
                                            href="{{ route('userProfile', ['id' => $user->id], false) }}">{{ $user->login }}</a>
                                    </h3>

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
                                    @if ($categories)
                                        <h3>Теги:
                                    @endif
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li>
                                                {{ DB::table('categories')->find($category->id)->name }}
                                                <ul>
                                                    @foreach (DB::table('under_categories_pictures')->where('picture_id', '=', $image->id)->get() as $under_category)
                                                        <li>
                                                            {{ DB::table('under_categories')->find($under_category->under_category_id)->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                    </h3>

                                    <!-- О картине -->
                                    <h3>О картине:</h3>
                                    <h6>{{ $image->about }}</h6>

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

                </div>
            </div>
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
                            <a class="btn btn-danger" href="{{ route('deletePicture', ['id' => $image->id]) }}">Удалить
                                картину</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection
