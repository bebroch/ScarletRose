<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Page Refresh</title>
</head>

<body>
    <button id="refresh-button">Обновить содержимое</button>
    <input type="text" id="search-input">

    <div id="updateDiv">
        <!-- Содержимое, которое будет обновляться -->
    </div>

    <script>
        document.getElementById('refresh-button').addEventListener('click', function() {
            var xhr = new XMLHttpRequest();

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Обновляем содержимое <div> новым HTML-контентом
                    document.getElementById('updateDiv').innerHTML = xhr.responseText;
                } else {
                    console.error('Ошибка при обновлении содержимого:', xhr.statusText);
                }
            };

            var search = document.getElementById('search-input').value;

            xhr.open('GET', '/updatebb?search=' + search, true);
            xhr.send();
        });
    </script>

</body>

</html>
