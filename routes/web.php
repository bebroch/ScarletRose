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

        // Добавить афишу
        Route::get('/AdminPanel/AddPoster', [AdminController::class, 'showAddPoster'])->name('addPoster');
        Route::get('/AdminPanel/AddPoster_process', [AdminController::class, 'addingPoster'])->name('addingPoster');

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
