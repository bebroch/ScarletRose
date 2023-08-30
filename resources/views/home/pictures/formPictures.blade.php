@if (empty($pictures->first()) && !empty($query))
    <div class="container-fluid text-center mt-3">
        По запросу "{{ $query }}" ничего не удалось найти.
    </div>
@endif

<div class="row row-cols-1 row-cols-md-3 mt-0 g-3">
    @foreach ($pictures as $picture)
        <div class="card-group">
            <div class="card rounded" style="display: flex; flex-direction: column; justify-content: space-between;">
                <a class="nav-link" href="{{ route('picture', ['id' => $picture->id]) }}">
                    <img src="{{ Storage::url("$picture->imagePath") }}" class="card-img-top rounded"
                        style="object-fit: cover; height: 40vh">
                    <div class="card-body" style="overflow: hidden;">
                        <h3 class="card-title">{{ $picture->name }}</h3>

                        @foreach (DB::table('under_categories_pictures')->where('picture_id', '=', $picture->id)->get() as $item)
                            {{ DB::table('under_categories')->find($item->under_category_id)->name }},
                        @endforeach

                        {{ $picture->width }}x{{ $picture->height }}, {{ $picture->DateCreate }}г.,
                        <?php $user = DB::table('users')->find($picture->user_id) ?>
                        {{ $user->firstname . " " . $user->lastname }}

                        @if ($picture->price)
                            <p><a style="font-weight: 700">Стоимость:</a> {{ number_format($picture->price, 0, ',', ' ') }}&#8381;</p>
                        @endif
                    </div>
                </a>

                @if ($isPersonalArea ?? false)
                    @auth('web')
                        <div class="card-footer">
                            <a class="btn btn-warning" href="{{ route('editPicture', ['id' => $picture->id]) }}">Редактировать
                                запись</a>
                            <!-- Кнопка-триггер модального окна -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#{{ $picture->id }}">
                                Удалить картину
                            </button>
                            @include('schems.deleteItemModalWindow', [
                                'item' => $picture,
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
                                data-bs-target="#{{ $picture->id }}">
                                Удалить картину
                            </button>
                            @include('schems.deleteItemModalWindow', [
                                'item' => $picture,
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
