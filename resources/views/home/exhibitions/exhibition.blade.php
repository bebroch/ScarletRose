@extends('schems.topPanelSchema')

@section('title')
    {{ $exhibition->title }}
@endsection

@section('content')
    <div class="container mt-4">
        @include('schems.backbutton')
        <h1>{{ $exhibition->title }}</h1>
        <h6>{{ $exhibition->start_at }} {{ $exhibition->end_at }}</h6>
        <p>{{ $exhibition->about }}</p>

        <div class="row row-cols-1 row-cols-md-3 mt-3 g-3">
            @foreach (DB::table('exhibitions_pictures')->where('exhibition_id', '=', $exhibition->id)->get() as $ligament)
                <?php $image = DB::table('pictures')->find($ligament->picture_id); ?>
                <div class="card-group">
                    <div class="card rounded" style="display: flex; flex-direction: column; justify-content: space-between;">
                        <a class="nav-link" href="{{ route('picture', ['id' => $image->id]) }}">
                            <img src="{{ Storage::url("$image->imagePath") }}" class="card-img-top rounded"
                                style="object-fit: cover; max-height: 40vh">
                            <div class="card-body">
                                <h3 class="card-title">{{ $image->name }}</h3>
                                <p class="card-text">{{ Str::limit($image->about, 100, '...') }}</p>
                                @if ($image->price)
                                    <p>Стоимость: {{ $image->price }}&#8381;</p>
                                @endif
                            </div>
                        </a>
                        @auth('web')
                            @if (Auth::user()->is_admin)
                                <div class="card-footer">
                                    <!-- Кнопка-триггер модального окна -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#{{ $image->id }}">
                                        Удалить картину
                                    </button>
                                </div>
                            @endif
                        @endauth
                    </div>

                    @include('schems.deleteItemModalWindow', [
                        'item' => $image,
                        'route' => 'adminPictureDelete_process',
                        'nameShape1' => 'картины',
                        'nameShape2' => 'картину',
                    ])
                </div>
            @endforeach
        </div>
    </div>
@endsection
