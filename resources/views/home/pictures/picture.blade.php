@extends('schems.topPanelSchema')

@section('title')
    {{ $picture->name }}
@endsection



@section('content')
    <div class="container-fliud mt-3 mb-3 " style="margin-inline: 5%;">
        @include('schems.backbutton')

        <div class="card">
            <div class="row g-0">
                <div class="col-md">
                    <img src="{{ Storage::url("$picture->imagePath") }}" class="img-fluid rounded-start">
                </div>
                <div class="col-md">
                    <div class="card-body">
                        <!-- Имя картины -->
                        <div class="text-center">
                            <h1>{{ $picture->name }}</h1>
                        </div>

                        <div class="container-fluid text-center">
                            <div class="row row-cols-1 row-cols-md-2 mt-0 g-3">

                                <!-- Кто нарисовал -->
                                <div class="col">
                                    <h2 style="font-weight: bold">Автор</h2>
                                    <h5><a class="link-info link-underline-opacity-0"
                                            href="{{ route('user', ['id' => $user->id], false) }}">{{ $user->firstname . ' ' . $user->lastname }}</a>
                                    </h5>

                                </div>


                                <!-- Участвует в выставках -->
                                <div class="col">


                                    @if (DB::table('exhibitions_pictures')->where('picture_id', '=', $picture->id)->get()->first())
                                        <h3 style="font-weight: bold">Участие в выставках:</h3>
                                    @endif
                                    @foreach (DB::table('exhibitions_pictures')->where('picture_id', '=', $picture->id)->get() as $exhibition)
                                        <h5>
                                            <a class="link-info link-underline-opacity-0"
                                                href="{{ route('exhibition', ['id' => $exhibition->exhibition_id]) }}">
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
                                    <h5><a style="font-weight: bold">Высота: </a>{{ $picture->height }}</h5>
                                    <h5><a style="font-weight: bold">Ширина: </a>{{ $picture->width }}</h5>

                                </div>
                            </div>
                        </div>


                        <!-- О картине -->
                        <h3 style="font-weight: bold">О картине:</h3>
                        <h3>{{ $picture->about }}</h3>

                        <!-- Стоимость -->
                        @if ($picture->price)
                            <h4>Стоимость: {{ $picture->price }}&#8381;</h4>
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

    @include('schems.deleteItemModalWindow', [
        'item' => $picture,
        'route' => 'adminPictureDelete_process',
        'nameShape1' => 'картины',
        'nameShape2' => 'картину',
    ])
@endsection
