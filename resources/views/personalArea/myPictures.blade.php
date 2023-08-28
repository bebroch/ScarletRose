@extends('schems.topPanelSchema')

@section('title')
    Мои картины
@endsection


@section('content')
    <div class="container-fluid mt-3">
        @include('schems.alerts', ['alterStatus' => 'success'])
        @include('schems.topName', ['name' => 'Мои картины'])

        @include('schems.search')

        <div class="container mb-3" id="search-results">
            @include('home.pictures.formPictures', ['isPersonalArea' => true])
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('search-button').addEventListener('click', function() {
            var xhr = new XMLHttpRequest();

            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('search-results').innerHTML = xhr.responseText;
                } else {
                    console.error('Ошибка при обновлении содержимого:', xhr.statusText);
                }
            };

            var search = document.getElementById('search-query').value;
            var route = '{{ route('searchMyPictures') }}';
            var filter = document.getElementById('filter-query').value;

            xhr.open('GET', route + '?search=' + search + '&filter=' + filter, true);
            xhr.send();
        });
    });
</script>

<style>
    /* Добавляем медиа-запрос для экранов шириной до 576px */
    @media (max-width: 576px) {
        .input-group-append {
            display: block;
            /* Переключаем на блочный элемент */
        }

        .form-select {
            max-width: 190px;

        }
    }

    @media (min-width: 577px) {
        .input-group-append {
            display: flex;
            width: 100%;
            /* Переключаем на блочный элемент */
        }

        .form-select {
            max-width: 190px;

        }

        .form-control {
            width: 100%;
        }
    }
</style>
