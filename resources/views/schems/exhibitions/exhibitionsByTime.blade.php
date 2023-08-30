<div class="tab-pane fade @if($status === 'active') show active @endif" id="v-pills-{{ $status }}" role="tabpanel" aria-labelledby="v-pills-{{ $status }}-tab">
    <div class="row row-cols-1 row-cols-md-3">
        @foreach ($exhibitions as $exhibition)
            <div class="col mt-3">
                <div class="card">
                    <a class="nav-link" href="{{ route('exhibition', ['id' => $exhibition->id]) }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $exhibition->title }}</h5>
                            <p class="card-text">{{ $exhibition->about }}</p>
                        </div>
                    </a>
                    <div class="card-footer bg-transparent border-success">
                        {{ Carbon\Carbon::parse($exhibition->start_at)->isoFormat('D MMMM YYYY года') }}
                        -
                        {{ Carbon\Carbon::parse($exhibition->end_at)->isoFormat('D MMMM YYYY года') }}
                    </div>
                    @auth('web')
                        @if (Auth::user()->is_admin)
                            <div class="card-footer">
                                <a class="btn btn-warning"
                                    href="{{ route('showEditExhibition', ['id' => $exhibition->id]) }}">Редактировать
                                    запись</a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>
