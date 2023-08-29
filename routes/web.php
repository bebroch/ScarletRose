<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;


/*
Route::get('/', function(){
    return redirect(route('aa'));
});


use App\Http\Controllers\AA\AAcontroller;

Route::group(['controller' => AAcontroller::class, 'prefix' => 'AA', ], function(){
    Route::get('/')->name('aa');
});

 */





// Перенаправление
Route::get('/', function () {
    return redirect(route('pictures'));
})->name('home');

route::group(['namespace' => 'App\Http\Controllers'], function(){

// Вход и регистрация
Route::group(['namespace' => 'Auth', 'prefix' => 'Auth'], function () {

    // Вход
    Route::group(['controller' => App\Http\Controllers\Auth\LoginController::class, 'prefix' => 'Login', 'controllers' => 'LoginController'], function () {
        Route::get('/login_process', 'process')->name('login_process');
    });

    // Регистрация
    Route::group(['controller' => App\Http\Controllers\Auth\RegisterController::class, 'prefix' => 'Registr'], function () {
        Route::get('/register_proccess', 'process')->name('register_proccess');
    });
});

// Главная страница
Route::group(['namespace' => 'Home', 'prefix' => 'Home'], function () {

    // Картины
    Route::group(['controller' => App\Http\Controllers\Home\Pictures\PicturesController::class, 'prefix' => 'Pictures'], function () {
        Route::get('/', 'showPictures')->name('pictures');
        Route::get('/{id}', 'showPicture')->name('picture');
    });

    // Поиск по всем картинам
    Route::group(['controller' => App\Http\Controllers\Home\Pictures\SearchController::class, 'prefix' => 'Search'], function () {
        Route::get('/', 'search_process')->name('searchGalleryPicture');
    });

    // Новости
    Route::group(['controller' => App\Http\Controllers\Home\News\NewsController::class, 'prefix' => 'News'], function () {
        Route::get('/', 'showNews')->name('news');
        Route::get('/{id}', 'showTheNews')->name('theNews');
    });

    // Афиша
    Route::group(['controller' => App\Http\Controllers\Home\Posters\PostersController::class, 'prefix' => 'Posters'], function () {
        Route::get('/', 'showPosters')->name('posters');
        Route::get('/{id}', 'showPoster')->name('poster');
    });

    // Выставка
    Route::group(['controller' => App\Http\Controllers\Home\Exhibitions\ExhibitionsController::class, 'prefix' => 'Exhibitions'], function () {
        Route::get('/', 'showExhibitions')->name('exhibitions');
        Route::get('/{id}', 'showExhibition')->name('exhibition');
    });

    // Пользователи
    Route::group(['controller' => App\Http\Controllers\Home\Users\UsersController::class, 'prefix' => 'Users'], function () {
        Route::get('/{id}', 'showUser')->name('user');
    });
});

// Личный кабинет
Route::group(['namespace' => 'Profile', 'middleware' => ['auth', 'verified'], 'prefix' => 'Profile'], function () {
    // Личный кабинет
    Route::group(['controller' => App\Http\Controllers\Profile\ProfileController::class], function () {
        Route::get('/', 'showProfile')->name('profile');
    });


    // Мои картины
    Route::group(['namespace' => 'MyPictures', 'prefix' => 'MyPictures'], function () {
        // Мои картины
        Route::group(['controller' => App\Http\Controllers\Profile\MyPictures\MyPicturesController::class], function () {
            Route::get('/', 'index')->name('myPictures');
        });

        // Поиск по моим картинам
        Route::group(['controller' => App\Http\Controllers\Profile\MyPictures\SearchController::class], function () {
            Route::get('/SearchMyPictures', 'index')->name('searchMyPictures');
        });

        // Добавить свою картину
        Route::group(['controller' => App\Http\Controllers\Profile\MyPictures\CreatePicture\CreatePictureController::class, 'prefix' => 'CreatePicture'], function () {
            Route::get('/', 'index')->name('createPicture');
            Route::get('/CreatePicture_process', 'process')->name('createPicture_process');
        });

        // Изменить свою картину
        Route::group(['controller' => App\Http\Controllers\Profile\MyPictures\EditPicture\EditPictureController::class, 'prefix' => 'EditPicture'], function () {
            Route::get('/', 'index')->name('editPicture');
            Route::get('/EditPicture_process', 'process')->name('editPicture_process');
        });

        // Удалить свою картину
        Route::group(['controller' => App\Http\Controllers\Profile\MyPictures\DeletePicture\DeletePictureController::class, 'prefix' => 'DeletePicture'], function () {
            Route::get('/DeletePicture_process', 'process')->name('deletePicture_process');
        });
    });

    // -------------------------------------------------------

    // Изменить информацию
    Route::group(['controller' => App\Http\Controllers\Profile\UpdateMyInformation\UpdateMyInformationController::class, 'prefix' => 'UpdateMyInformation'], function () {
        Route::get('/', 'index')->name('updateInfo');
        Route::get('/UpdateMyInformation_process', 'process')->name('updateInfo_process');
    });

});

// Админ панель
Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'isadmin', 'verified'], 'prefix' => 'AdminPanel'], function () {

    // Добавить новость
    Route::group(['controller' => App\Http\Controllers\Admin\News\NewsController::class, 'prefix' => 'AddNews'], function () {
        Route::get('/', 'index')->name('addNews');
        Route::get('/AddNews_process', 'addProcess')->name('addNews_process');
        Route::get('/DeleteNews_process', 'deleteProcess')->name('deleteNews_process');
    });

    // Добавить Афишу
    Route::group(['controller' => App\Http\Controllers\Admin\Posters\PostersController::class, 'prefix' => 'AddPoster'], function () {
        Route::get('/', 'index')->name('addPoster');
        Route::get('/AddPoster_process', 'addProcess')->name('addPoster_process');
        Route::get('/Delete_process', 'deleteProcess')->name('deletePoster_process');
    });

    // Добавить Выставку
    Route::group(['controller' => App\Http\Controllers\Admin\Exhibitions\ExhibitionsController::class, 'prefix' => 'Exhibition'], function () {
        Route::get('/Create', 'create')->name('addExhibition');
        Route::get('/Create_process', 'createProcess')->name('addExhibition_process');
        Route::get('/Edit', 'edit')->name('editExhibition');
        Route::get('/Edit_process', 'editProcess')->name('editExhibition_process');
        Route::get('/Delete_process', 'deleteProcess')->name('deleteExhibition_process');
    });

    // -------------------------------------------------------

    // Модерация картин
    Route::group(['controller' => App\Http\Controllers\Admin\ModerationPicture\ModerationPictureController::class, 'prefix' => 'Moderation'], function () {
        Route::get('/', 'index')->name('moderationPictures');
        Route::get('/PictureAccept', 'accept')->name('pictureAccept');
        Route::get('/PictureDelete', 'delete')->name('pictureDelete');
    });

    // Пользователи
    Route::group(['controller' => App\Http\Controllers\Admin\Users\UsersController::class, 'prefix' => 'Users'], function () {
        Route::get('/', 'index')->name('adminUsers');
        Route::get('/{id}', 'showUser')->name('adminUser');
        Route::get('/{id}_deleteProcess', 'deleteProcess')->name('deleteUser');
    });

    // Категории
    Route::group(['namespace' => 'Category', 'prefix' => 'Categories'], function () {

        //Категории
        Route::group(['controller' => App\Http\Controllers\Admin\Categories\CategoriesController::class, 'prefix' => 'Categories'], function () {
            Route::get('/', 'index')->name('categories');
            Route::get('/AddCategory', 'addProcess')->name('addCategory');
            Route::get('/DeleteCategory', 'deleteProcess')->name('deleteCategory');
        });

        // Подкатегории
        Route::group(['controller' => App\Http\Controllers\Admin\Categories\UnderCategoriesController::class, 'prefix' => 'Categories'], function () {
            Route::get('/AddUnderCategory', 'addProcess')->name('addUnderCategory');
            Route::get('/DeleteUnderCategory', 'deleteProcess')->name('deleteUnderCategory');
        });
    });

    // Установка Storage:link
    Route::get('/linkstorage', function () {
        Artisan::call('storage:link');
    });
});
});




/*

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
//Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login_process', [AuthController::class, 'login'])->name('login_process');

// Перенаправление
Route::get('/', function () {
    return redirect(route('home'));
});

Auth::routes(['verify' => true]);




Route::get('/bb', function () {
    return view('testblade');
});

Route::get('/updatebb', function (Request $request) {
    $search = $request->search;

    return view('testbladeUpdate', compact('search'));
});
 */
