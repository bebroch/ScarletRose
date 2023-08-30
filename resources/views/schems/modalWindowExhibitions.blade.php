<div class="modal fade" id="exhibitionWindow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Добавить на выставки</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Активные
                            выставки</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Будущие
                            выставки</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @foreach (DB::table('exhibitions')->where([['start_at', '<', now()], ['end_at', '>', now()]])->get() as $exhibition)
                            <label>
                                @if ($pressCheck)
                                    @php
                                        $exhibitionIDsInDB = DB::table('exhibitions_pictures')
                                            ->where('picture_id', '=', $picture_id)
                                            ->pluck('exhibition_id')
                                            ->toArray();
                                        $isChecked = in_array($exhibition->id, $exhibitionIDsInDB);
                                    @endphp
                                    <input class="activeCheckBox" hidden type="checkbox" name="exhibitions[]"
                                        @if ($isChecked) checked @endif value="{{ $exhibition->id }}">
                                @else
                                    <input class="activeCheckBox" hidden type="checkbox" name="exhibitions[]"
                                        value="{{ $exhibition->id }}">
                                @endif
                                <div class="card mb-3 cheboxContainer noselect" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $exhibition->title }}</h5>
                                                <p class="card-text">{{ $exhibition->about }}</p>
                                                <p class="card-text"><small class="text-muted">Выставка началась

                                                        {{ Carbon\Carbon::parse($exhibition->start_at)->diffForHumans() }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @endforeach

                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @foreach (DB::table('exhibitions')->where([['start_at', '>', now()]])->get() as $exhibition)
                            <label>
                                @if ($pressCheck)
                                    @php
                                        $exhibitionIDsInDB = DB::table('exhibitions_pictures')
                                            ->where('picture_id', '=', $picture_id)
                                            ->pluck('exhibition_id')
                                            ->toArray();
                                        $isChecked = in_array($exhibition->id, $exhibitionIDsInDB);
                                    @endphp
                                    <input class="activeCheckBox" hidden type="checkbox" name="exhibitions[]"
                                        @if ($isChecked) checked @endif value="{{ $exhibition->id }}">
                                @else
                                    <input class="activeCheckBox" hidden type="checkbox" name="exhibitions[]"
                                        value="{{ $exhibition->id }}">
                                @endif
                                <div class="card mb-3 cheboxContainer noselect" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-8">
                                            <div class=" card-body">
                                                <h5 class="card-title">{{ $exhibition->title }}</h5>
                                                <p class="card-text">{{ $exhibition->about }}</p>
                                                <p class="card-text"><small class="text-muted">Выставка начнётся

                                                        {{ Carbon\Carbon::parse($exhibition->start_at)->diffForHumans() }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Добавить</button>
            </div>
        </div>
    </div>
</div>
