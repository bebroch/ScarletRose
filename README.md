Как запускать:
Скопировать .env.example и переименовать в .env
Прописать .env
>> composer install
>> php artisan key:generate
>> php artisan config:clear
>> php artisan cache:clear
>> npm install
Подключить ДБ
>> php artisan migrate
>> php artisan migrate --seed
Запустить фронт
>> npm run dev

1:
composer install
php artisan key:generate
php artisan config:clear
php artisan cache:clear
npm install

2:
php artisan migrate
php artisan migrate --seed

3:
npm run dev



О проекте:
Работаю с OSPanel, MySQL, phpMyAdmin, php_8.1, bootstrap, Laravel, Windows 10
На сайте есть Галерея - все картины, Новости, которые добавляет админ, Афиши - новости, которые предпологают о встрече, Выставки - где собраный названия выставок и там же картины к ним.
Есть личный кабинет, в котором есть пункты Мои картины, Добавить картину, Обо мне и Изменить информацию
Так же есть Админ панель, в которой есть пункты с добавление информации, такие как Добавить Новость, Афишу и Выставку. Модерирущие пункты такие, как Картины на проверке, человек не может загрузить картину на выставку, она должна пройти проверку, Пользователи, Категории, которые можно менять в случае чего.
На сайте есть верификация аккаунта с помощью Email и Востановление пароля.
