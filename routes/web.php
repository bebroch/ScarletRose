<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateCardController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PersonalAreaController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;



/*

// Перенаправление
Route::get('/', function () {
    return redirect(route('home'));
});

// Вход и регистрация
Route::group(['namespace' => 'Auth', 'prefix' => 'Auth'], function(){

    // Вход
    Route::group(['namespace' => 'Login', 'prefix' => 'Login'], function(){
        Route::get('/', 'LoginController')->name('login');
        Route::get('/logout', 'LoginController')->name('logout');
        Route::get('/login_process', 'LoginController')->name('login_process');
    });

    // Регистрация
    Route::group(['namespace' => 'Registr', 'prefix' => 'Registr'], function(){
        Route::get('/', 'RegisterController')->name('register');
        Route::get('/register_proccess', 'RegisterController')->name('register_proccess');
    });
});

// Главная страница
Route::group(['namespace' => 'Home', 'prefix' => 'Home'], function(){

    // Картины
    Route::group(['namespace' => 'Pictures', 'prefix' => 'Pictures'], function(){
        Route::get('/', 'PicturesController')->name('pictures');
        Route::get('/{id}', 'PicturesController')->name('picture');
    });

    // Новости
    Route::group(['namespace' => 'News', 'prefix' => 'News'], function(){
        Route::get('/', 'NewsController')->name('news');
        Route::get('/{id}', 'NewsController')->name('new');
    });

    // Афиша
    Route::group(['namespace' => 'Posters', 'prefix' => 'Posters'], function(){
        Route::get('/', 'PostersController')->name('posters');
        Route::get('/{id}', 'PostersController')->name('poster');
    });

    // Выставка
    Route::group(['namespace' => 'Exhibitions', 'prefix' => 'Exhibibtions'], function(){
        Route::get('/', 'ExhibitionsController')->name('exhibibtions');
        Route::get('/{id}', 'ExhibitionsController')->name('exhibibtion');
    });
});

// Личный кабинет
Route::group(['namespace' => 'Profile', 'middleware' => ['auth', 'verified'], 'prefix' => 'Profile'], function(){

    // Мои картины
    Route::group(['namespace' => 'MyPictures', 'prefix' => 'MyPictures'], function(){
        Route::get('/', 'MyPicturesController')->name('myPictures');
        Route::get('/SearchMyPictures', 'SearchController')->name('searchMyPictures');

        // Добавить свою картину
        Route::group(['namespace' => 'CreatePicture', 'prefix' => 'CreatePicture'], function(){
            Route::get('/', 'CreatePictureController')->name('CreatePicture');
            Route::get('/CreatePicture_process', 'CreatePictureController')->name('CreatePicture_process');
        });

        // Изменить свою картину
        Route::group(['namespace' => 'EditPicture', 'prefix' => 'EditPicture'], function(){
            Route::get('/', 'EditPictureController')->name('EditPicture');
            Route::get('/EditPicture_process', 'EditPictureController')->name('EditPicture_process');
        });

        // Удалить свою картину
        Route::group(['namespace' => 'DeletePicture', 'prefix' => 'DeletePicture'], function(){
            Route::get('/', 'DeletePictureController')->name('DeletePicture');
            Route::get('/DeletePicture_process', 'DeletePictureController')->name('DeletePicture_process');
        });
    });

    // Обо мне
    Route::group(['namespace' => 'About', 'prefix' => 'About'], function(){
        Route::get('/', 'AboutController')->name('about');
    });

    // -------------------------------------------------------

    // Изменить информацию
    Route::group(['namespace' => 'UpdateMyInformation', 'prefix' => 'UpdateMyInformation'], function(){
        Route::get('/', 'UpdateMyInformationController')->name('updateInfo');
        Route::get('/UpdateMyInformation_process', 'UpdateMyInformationController')->name('updateInfo_process');
    });

});

// Админ панель
Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'isadmin', 'verified'], 'prefix' => 'AdminPanel'], function(){

    // Добавить новость
    Route::group(['namespace' => 'AddingNews', 'prefix' => 'AddNews'], function(){
        Route::get('/', 'NewsController')->name('addNews');
        Route::get('/AddNews_process', 'NewsController')->name('addNews_process');
    });

    // Добавить Афишу
    Route::group(['namespace' => 'AddPoster', 'prefix' => 'AddPoster'], function(){
        Route::get('/', 'AddPosterController')->name('addPoster');
        Route::get('/AddPoster_process', 'AddPosterController')->name('addPoster_process');
    });

    // Добавить Выставку
    Route::group(['namespace' => 'AddExhibition', 'prefix' => 'Exhibition'], function(){
        Route::get('/Create', 'ExhibitionController')->name('addExhibition');
        Route::get('/Create_process', 'ExhibitionController')->name('addExhibition_process');
        Route::get('/Edit', 'ExhibitionController')->name('editExhibition');
        Route::get('/Edit_process', 'ExhibitionController')->name('editExhibition_process');
        Route::get('/Delete', 'ExhibitionController')->name('deleteExhibition_process');
    });

    // -------------------------------------------------------

    // Модерация картин
    Route::group(['namespace' => 'ModerationPicture', 'prefix' => 'Moderation'], function(){
        Route::get('/', 'ModerationPictureController')->name('moderationPictures');
        Route::get('/PictureAccept', 'ModerationPictureController')->name('pictureAccept');
        Route::get('/PictureDelete', 'DeletePictureController')->name('pictureDelete');
    });

    // Пользователи
    Route::group(['namespace' => 'Users', 'prefix' => 'Users'], function(){
        Route::get('/', 'UsersController')->name('AdminUsers');
        Route::get('/{id}', 'UsersController')->name('AdminUser');
        Route::get('/{id}/DeleteUser', 'DeleteUserController')->name('DeleteUser');
    });

    // Категории
    Route::group(['namespace' => 'Categories', 'prefix' => 'Categories'], function(){
        Route::get('/', 'CategoryController')->name('categories');
        Route::get('/AddCategory', 'CategoryController')->name('AddCategory');
        Route::get('/AddUnderCategory', 'UnderCategoryController')->name('AddUnderCategory');
        Route::get('/DeleteCategory', 'CategoryController')->name('DeleteCategory');
        Route::get('/DeleteUnderCategory', 'UnderCategoryController')->name('DeleteUnderCategory');
    });

    // Установка Storage:link
    Route::get('/linkstorage', function () {
        Artisan::call('storage:link');
    });
});

*/









Route::group(['middleware' => ['auth', 'verified']], function () {

    // Создание и удаления картины
    Route::get('/CreateCard', [CreateCardController::class, 'create'])->name('createCard');

    // Личный кабинет
    Route::get('/PersonalArea', [PersonalAreaController::class, 'showPersonalArea'])->name('personalArea');
    // Мои картины
    Route::get('/PersonalArea/MyPictures', [PersonalAreaController::class, 'showMyPictureForm'])->name('myPictures');
    // Поиск
    Route::get('/PersonalArea/MyPictures/search', [PersonalAreaController::class, 'search'])->name('searchMyPictures');
    // Добавить картину
    Route::get('/PersonalArea/AddMyPicture', [PersonalAreaController::class, 'showAddMyPictureForm'])->name('addPicture');
    Route::post('/PersonalArea/AddMyPicture/adderPicture_process', [PersonalAreaController::class, 'adderPicture'])->name('adderPicture');
    // Изменить картину
    Route::get('/PersonalArea/MyPictures/{id}/editPicture', [PersonalAreaController::class, 'editMyPicture'])->name('editMyPicture');
    Route::post('/PersonalArea/MyPictures/editPicture_process', [PersonalAreaController::class, 'editMyPicture_process'])->name('editMyPicture_process');
    // Удалить картину
    Route::get('/PersonalArea/AddMyPicture/{id}/deletePicture_process', [PersonalAreaController::class, 'deletePicture'])->name('deleteMyPicture');
    // Обновить информацию
    Route::get('/PersonalArea/UpdateMyInformation', [PersonalAreaController::class, 'showUpdateMyInformationForm'])->name('updateInformation');
    Route::post('/PersonalArea/UpdateMyInformation/UpdateMyInformation_process', [PersonalAreaController::class, 'updateMyInformationForm_process'])->name('updateInformation_process');

    // Админ панель
    Route::group(['middleware' => ['auth', 'isadmin']], function () {
        // Добавить новость
        Route::get('/AdminPanel', [AdminController::class, 'index'])->name('admin');
        Route::get('/AdminPanel/AddNew', [AdminController::class, 'showAddNew'])->name('addNew');
        Route::get('/AdminPanel/AddNew_process', [AdminController::class, 'addingNew'])->name('addingNew');
        Route::get('/AdminPanel/{id}/deleteNew_process', [AdminController::class, 'deleteNew_process'])->name('deleteNew_process');

        // Добавить афишу
        Route::get('/AdminPanel/AddPoster', [AdminController::class, 'showAddPoster'])->name('addPoster');
        Route::get('/AdminPanel/AddPoster_process', [AdminController::class, 'addingPoster'])->name('addingPoster');
        Route::get('/AdminPanel/{id}/DeletePoster_process', [AdminController::class, 'deletePoster_process'])->name('deletePoster_process');

        // Добавить категорию
        Route::get('/AdminPanel/AddCategory', [AdminController::class, 'showAddCategory'])->name('addCategory');
        Route::get('/AdminPanel/AddUnderCategory_process', [AdminController::class, 'addingUnderCategory'])->name('addingUnderCategory');
        Route::get('/AdminPanel/AddCategory_process', [AdminController::class, 'addingCategory'])->name('addingCategory');
        Route::get('/AdminPanel/DeleteCategory_process', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
        Route::get('/AdminPanel/DeleteUnderCategory_process', [AdminController::class, 'deleteUnderCategory'])->name('deleteUnderCategory');

        // Удалить картину
        Route::get('/AdminPanel/{id}/DeletePicture_process', [AdminController::class, 'deletePicture'])->name('deletePicture');

        // Добавить Выставку
        Route::get('/AdminPanel/AddExhibition', [AdminController::class, 'showAddExhibition'])->name('addExhibition');
        Route::get('/AdminPanel/AddingExhibition_process', [AdminController::class, 'addingExhibition'])->name('addingExhibition');
        Route::get('/AdminPanel/EditExhibition/{id}', [AdminController::class, 'showEditExhibition'])->name('editExhibition');
        Route::get('/AdminPanel/editExhibition_process', [AdminController::class, 'showEditExhibition_process'])->name('editExhibition_process');
        Route::get('/AdminPanel/deleteExhibition_process/{id}', [AdminController::class, 'deletingExhibition'])->name('deletingExhibition');

        // Модерация картин
        Route::get('/AdminPanel/PictureVerification', [AdminController::class, 'pictureVerification'])->name('AdminPictureVerification');
        Route::get('/AdminPanel/PictureVerification/PictureAccepting/{id}', [AdminController::class, 'pictureAccepting'])->name('pictureAccepting');


        // Пользователи
        Route::get('/AdminPanel/Users', [AdminController::class, 'showUsers'])->name('AdminUsers');
        Route::get('/AdminPanel/Users/{id}', [AdminController::class, 'showUser'])->name('AdminUser');
        Route::get('/AdminPanel/Users/{id}/deleteUser_process', [AdminController::class, 'deleteUser'])->name('deleteUser');

        // Установка Storage:link
        Route::get('/linkstorage', function () {
            Artisan::call('storage:link');
        });
    });
});

// Основная страница (Картины)
Route::get('/pictures', [HomePageController::class, 'showPictures'])->name('home');
Route::get('/pictures/{id}', [HomePageController::class, 'showPictures_id'])->name('picture');
// Новости
Route::get('/news', [HomePageController::class, 'showNews'])->name('news');
Route::get('/news/{id}', [HomePageController::class, 'showNews_id']);
// Афиши
Route::get('/posters', [HomePageController::class, 'showPosters'])->name('posters');
Route::get('/posters/{id}', [HomePageController::class, 'showPosters_id']);
// Выставки
Route::get('/exhibitions', [HomePageController::class, 'showExhibitions'])->name('exhibitions');
Route::get('/exhibitions/{id}', [HomePageController::class, 'showExhibition_id'])->name('exhibition');
// Личная страница пользователя
Route::get('/user/{id}', [HomePageController::class, 'userProfile'])->name('userProfile');
// Поиск
Route::get('/search', [HomePageController::class, 'search'])->name('search');

// Регистрация
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register_proccess', [AuthController::class, 'register'])->name('register_process');

// Вход
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login_process', [AuthController::class, 'login'])->name('login_process');

// Перенаправление
Route::get('/', function () {
    return redirect(route('home'));
});

Auth::routes(['verify' => true]);

Route::get('/aa', function () {
    User::where('email', '=', 'xyusose@yandex.ru')->delete();

    $user = User::create([
        'login' => 'asdasdas',
        'email' => 'xyusose@yandex.ru',
        'password' => bcrypt('asdsadasdgashjg'),
    ]);

    return event(new Registered($user));


});
