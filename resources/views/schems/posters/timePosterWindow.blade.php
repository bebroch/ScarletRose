<div class="tab-pane fade @if ($tab === 'active') show active @endif" id="v-pills-{{ $tab }}"
    role="tabpanel" aria-labelledby="v-pills-{{ $tab }}-tab">

    <div class="row row-cols-1 g-3 row-cols-md-2">
        @foreach ($posters as $poster)
            <div class="card-deck mt-2">
                <div class="card">
                    <a href="{{ route('posters') }}/{{ $poster->id }}" class="nav-link">
                        <div class="card-body">
                            <h3 class="card-title" style="font-weight: bold">{{ $poster->name }}</h3>
                            <p class="card-text">
                            <h5>{{ $poster->about }}</h5>
                            </p>
                        </div>
                    </a>

                    @auth('web')
                        @if (Auth::user()->is_admin)
                            <div class="card-footer">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#{{ $poster->id }}">
                                    Удалить афишу
                                </button>
                            </div>

                            @include('schems.deleteItemModalWindow', [
                                'item' => $poster,
                                'route' => 'deletePoster_process',
                                'nameShape1' => 'афиши',
                                'nameShape2' => 'афишу',
                            ])
                        @endif
                    @endauth
                    <div class="card-footer">
                        @include('schems.posters.climaxTime', [])
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>


{{--

'isdateNotEmpty' => !empty($poster->timeEventEnd),
'isdateNotEmpty' => !empty($poster->timeEventStart),
'isdateNotEmpty' => empty($poster->date),

 --}}
