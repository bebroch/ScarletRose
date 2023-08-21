@extends('schems.topPanelSchema')

@section('title')
    Изменить выставку
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('editExhibition_process') }}">
            @csrf
            <input type="text" value="{{ $exhibition->id }}" hidden name="id">
            <input placeholder="Название выставки" value="{{ $exhibition->title }}" type="text" name="title"><br>
            <label for="start_at">Дата начала</label>
            <input placeholder="Дата начала" value="{{ $exhibition->start_at }}" type="date" name="start_at"><br>
            <label for="end_at">Дата окончания</label>
            <input placeholder="Дата окончания" value="{{ $exhibition->end_at }}" type="date" name="end_at"><br>
            <textarea placeholder="О чём будет выставка" name="about" cols="30" rows="10">{{ $exhibition->about }}</textarea><br>
            <input type="submit" class="btn btn-success" value="Изменить">
        </form>
        <!-- Кнопка-триггер модального окна -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Удалить Запись
        </button>

    </div>

    <!-- Модальное окно -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Удаление Выставки</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    Вы действительно хотите удалить выставку - {{ $exhibition->title }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <a class="btn btn-danger" href="{{ route('deletingExhibition', ['id' => $exhibition->id]) }}">Удалить
                        запись</a>
                </div>
            </div>
        </div>
    </div>
@endsection
