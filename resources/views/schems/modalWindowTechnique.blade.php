<div class="modal fade" id="techniqueWindow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Добавить техники</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-1 row-cols-md-3 g-1">
                    @foreach ($categories as $category)
                        <div>

                            <?php
                            $under_categories = DB::table('under_categories')
                                ->where('category_id', '=', $category->id)
                                ->get();
                            ?>

                            <div>
                                @if (!empty($under_categories))
                                    <label style="font-size: 18px; font-weight:bold">{{ $category->name }}</label><br>
                                @endif
                            </div>
                            <div>
                                @foreach ($under_categories as $item)
                                    <ul class="list-group mt-1">

                                        <label>
                                            <input class="activeCheckBox" hidden type="checkbox"
                                                id="{{ $category->name }}" name="under_categories[]"
                                                value="{{ $item->id }}"
                                                onclick="onlyOne(this, '{{ $category->name }}')">
                                            <li class="list-group-item cheboxContainer">
                                                {{ $item->name }}
                                            </li>

                                        </label>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div>
                        <label style="font-size: 18px; font-weight:bold">
                            <input type="checkbox" name="checkPrice"
                                onclick="var input = document.getElementById('price'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}">
                            На продажу
                        </label>
                        <input disabled name="price" id="price" style="width:90%">
                        <label for="price">&#8381;</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Добавить</button>
            </div>
        </div>
    </div>
</div>
