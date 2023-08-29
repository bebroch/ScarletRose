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
                <a class="btn btn-danger" href="{{ route('deletePicture_process', ['id' => $image->id]) }}">Удалить
                    картину</a>
            </div>
        </div>
    </div>
</div>
