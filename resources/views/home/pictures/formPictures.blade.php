@if (empty($images->first()) && !empty($query))
    <div class="container-fluid text-center mt-3">
        По запросу "{{ $query }}" ничего не удалось найти.
    </div>
@endif

<div class="row row-cols-1 row-cols-md-3 mt-0 g-3">
    @foreach ($images as $image)
        <div class="card-group">
            <div class="card rounded" style="display: flex; flex-direction: column; justify-content: space-between;">
                <a class="nav-link" href="{{ route('picture', ['id' => $image->id]) }}">
                    <img src="{{ Storage::url("$image->imagePath") }}" class="card-img-top rounded"
                        style="object-fit: cover; max-height: 40vh">
                    <div class="card-body" style="overflow: hidden;">
                        <h3 class="card-title">{{ $image->name }}</h3>
                        <p class="card-text">{{ Str::limit($image->about, 100, '...') }}</p>
                        @if ($image->price)
                            <p>Стоимость: {{ $image->price }}&#8381;</p>
                        @endif
                    </div>
                </a>

                @if ($isPersonalArea ?? false)
                    @auth('web')
                        <div class="card-footer">
                            <a class="btn btn-warning" href="{{ route('editPicture', ['id' => $image->id]) }}">Редактировать
                                запись</a>
                            <!-- Кнопка-триггер модального окна -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#{{ $image->id }}">
                                Удалить картину
                            </button>
                            @include('schems.deleteItemModalWindow', [
                                'item' => $image,
                                'route' => 'deletePicture_process',
                                'nameShape1' => 'картины',
                                'nameShape2' => 'картину',
                            ])
                        </div>
                    @endauth
                @endif

                @auth('web')
                    @if (Auth::user()->is_admin && !($isPersonalArea ?? false))
                        <div class="card-footer">
                            <!-- Кнопка-триггер модального окна -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#{{ $image->id }}">
                                Удалить картину
                            </button>
                            @include('schems.deleteItemModalWindow', [
                                'item' => $image,
                                'route' => 'adminPictureDelete_process',
                                'nameShape1' => 'картины',
                                'nameShape2' => 'картину',
                            ])
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    @endforeach
</div>
