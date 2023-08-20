<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateCardController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PersonalAreaController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;


Route::middleware(['web'])->group(function(){

    // Создание и удаления картины
    Route::get('/CreateCard', [CreateCardController::class, 'create'])->name('createCard');
    Route::get('/DeliteCard', [CreateCardController::class, 'delite'])->name('deliteCard');

    // Личный кабинет
    Route::get('/PersonalArea', [PersonalAreaController::class, 'showPersonalArea'])->name('personalArea');
    // Мои картины
    Route::get('/PersonalArea/MyPictures', [PersonalAreaController::class, 'showMyPictureForm'])->name('myPictures');
    // Добавить картину
    Route::get('/PersonalArea/AddMyPicture', [PersonalAreaController::class, 'showAddMyPictureForm'])->name('addPicture');
    Route::post('/PersonalArea/AddMyPicture/adderPicture_process', [PersonalAreaController::class, 'adderPicture'])->name('adderPicture');
    // Обновить информацию
    Route::get('/PersonalArea/UpdateMyInformation', [PersonalAreaController::class, 'showUpdateMyInformationForm'])->name('updateInformation');
    Route::post('/PersonalArea/UpdateMyInformation/UpdateMyInformation_process', [PersonalAreaController::class, 'updateMyInformationForm_process'])->name('updateInformation_process');

    // Админ панель
    Route::group(['middleware' => ['auth', 'isadmin']], function(){
        // Добавить новость
        Route::get('/AdminPanel', [AdminController::class, 'index'])->name('admin');
        Route::get('/AdminPanel/AddNew', [AdminController::class, 'showAddNew'])->name('addNew');
        Route::get('/AdminPanel/AddNew_process', [AdminController::class, 'addingNew'])->name('addingNew');

        // Добавить афишу
        Route::get('/AdminPanel/AddPoster', [AdminController::class, 'showAddPoster'])->name('addPoster');
        Route::get('/AdminPanel/AddPoster_process', [AdminController::class, 'addingPoster'])->name('addingPoster');

        // Добавить категорию
        Route::get('/AdminPanel/AddCategory', [AdminController::class, 'showAddCategory'])->name('addCategory');
        Route::get('/AdminPanel/AddUnderCategory_process', [AdminController::class, 'addingUnderCategory'])->name('addingUnderCategory');
        Route::get('/AdminPanel/AddCategory_process', [AdminController::class, 'addingCategory'])->name('addingCategory');
        Route::get('/AdminPanel/DeleteCategory_process', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
        Route::get('/AdminPanel/DeleteUnderCategory_process', [AdminController::class, 'deleteUnderCategory'])->name('deleteUnderCategory');
        Route::get('/AdminPanel/DeletePicture_process', [AdminController::class, 'deletePicture'])->name('deletePicture');

        // Страница Поиска
        Route::get('/AdminPanel/Search', [AdminController::class, 'showSearch'])->name('AdminSearch');
        // Пользователи
        Route::get('/AdminPanel/Users', [AdminController::class, 'showUsers'])->name('AdminUsers');
        Route::get('/AdminPanel/Users/{id}', [AdminController::class, 'showUser'])->name('AdminUser');
        Route::get('/AdminPanel/Users/{id}/deleteUser_process', [AdminController::class, 'deleteUser'])->name('deleteUser');

        Route::get('/linkstorage', function () {
            Artisan::call('storage:link');
        });
    });
});

// Основная страница (Картины)
Route::get('/pictures', [HomePageController::class, 'showPictures'])->name('home');
Route::get('/pictures/{id}', [HomePageController::class, 'showPictures_id']);
// Новости
Route::get('/news', [HomePageController::class, 'showNews'])->name('news');
Route::get('/news/{id}', [HomePageController::class, 'showNews_id']);
// Афиши
Route::get('/posters', [HomePageController::class, 'showPosters'])->name('posters');
Route::get('/posters/{id}', [HomePageController::class, 'showPosters_id']);
// Выставки
Route::get('/exhibitions', [HomePageController::class, 'showExhibitions'])->name('exhibitions');
Route::get('/exhibitions/{id}', [HomePageController::class, 'showExhibition_id']);
// Личная страница пользователя
Route::get('/user/{id}', [HomePageController::class, 'userProfile'])->name('userProfile');

// Регистрация
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register_proccess', [AuthController::class, 'register'])->name('register_process');

// Вход
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login_process', [AuthController::class, 'login'])->name('login_process');

// Перенаправление
Route::post('/', function(){
    return route('home');
});
