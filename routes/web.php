<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;




// Route get 'name' 'showName' -> name('name')
// Route get 'name_process' 'nameProcess' -> name('name_process')



// Перенаправление
Route::get('/', function () {
    return redirect(route('pictures'));
})->name('home');

Auth::routes(['verify' => true]);

route::group(['namespace' => 'App\Http\Controllers'], function () {

    // Вход и регистрация
    Route::group(['namespace' => 'Auth', 'prefix' => 'Auth'], function () {

        // Вход
        Route::group(['controller' => App\Http\Controllers\Auth\LoginController::class, 'prefix' => 'Login', 'controllers' => 'LoginController'], function () {
            Route::get('/', 'showLogin')->name('login');
            Route::get('/login_process', 'process')->name('login_process');
        });

        // Регистрация
        Route::group(['controller' => App\Http\Controllers\Auth\RegisterController::class, 'prefix' => 'Registr'], function () {
            Route::get('/', 'showRegister')->name('register');
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
        Route::group(['controller' => App\Http\Controllers\Home\Search\SearchController::class, 'prefix' => 'Search'], function () {
            Route::get('/', 'process')->name('searchGalleryPicture_process');
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
                Route::get('/', 'showMyPicture')->name('myPictures');
            });

            // Поиск по моим картинам
            Route::group(['controller' => App\Http\Controllers\Profile\MyPictures\SearchController::class, 'prefix' => 'SearchMyPictures'], function () {
                Route::get('/', 'process')->name('searchMyPictures');
            });

            // Добавить свою картину
            Route::group(['controller' => App\Http\Controllers\Profile\MyPictures\CreatePicture\CreatePictureController::class, 'prefix' => 'CreatePicture'], function () {
                Route::get('/', 'showCreaterPicture')->name('createPicture');
                Route::post('/CreatePicture_process', 'process')->name('createPicture_process');
            });

            // Изменить свою картину
            Route::group(['controller' => App\Http\Controllers\Profile\MyPictures\EditPicture\EditPictureController::class, 'prefix' => 'EditPicture'], function () {
                Route::get('/{id}', 'showEditPicture')->name('editPicture');
                Route::post('/{id}_EditPicture_process', 'process')->name('editPicture_process');
            });

            // Удалить свою картину
            Route::group(['controller' => App\Http\Controllers\Profile\MyPictures\DeletePicture\DeletePictureController::class, 'prefix' => 'DeletePicture'], function () {
                Route::get('/{id}', 'process')->name('deletePicture_process');
            });
        });

        // -------------------------------------------------------

        // Изменить информацию
        Route::group(['controller' => App\Http\Controllers\Profile\UpdateMyInformation\UpdateMyInformationController::class, 'prefix' => 'UpdateMyInformation'], function () {
            Route::get('/', 'showUpdateMyInfo')->name('updateInfo');
            Route::get('/UpdateMyInformation_process', 'process')->name('updateInfo_process');
        });

    });

    // Админ панель
    Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'isadmin', 'verified'], 'prefix' => 'AdminPanel'], function () {

        // Добавить новость
        Route::group(['controller' => App\Http\Controllers\Admin\News\NewsController::class, 'prefix' => 'CreateNews'], function () {
            Route::get('/', 'showCreateNews')->name('createNews');
            Route::get('/CreateNews_process', 'createProcess')->name('createNews_process');
            Route::get('/{id}_DeleteNews_process', 'deleteProcess')->name('deleteNews_process');
        });

        // Добавить Афишу
        Route::group(['controller' => App\Http\Controllers\Admin\Posters\PostersController::class, 'prefix' => 'CreatePoster'], function () {
            Route::get('/', 'showCreatePoster')->name('createPoster');
            Route::get('/CreatePoster_process', 'createProcess')->name('createPoster_process');
            Route::get('/{id}_Delete_process', 'deleteProcess')->name('deletePoster_process');
        });

        // Добавить Выставку
        Route::group(['controller' => App\Http\Controllers\Admin\Exhibitions\ExhibitionsController::class, 'prefix' => 'Exhibition'], function () {
            Route::get('/Create', 'showCreateExhibition')->name('createExhibition');
            Route::get('/Create_process', 'createProcess')->name('createExhibition_process');
            Route::get('/{id}_Edit', 'showEditExhibition')->name('showEditExhibition');
            Route::get('/{id}_Edit_process', 'editProcess')->name('editExhibition_process');
            Route::get('/{id}_Delete_process', 'deleteProcess')->name('deleteExhibition_process');
        });

        // -------------------------------------------------------

        // Модерация картин
        Route::group(['controller' => App\Http\Controllers\Admin\ModerationPicture\ModerationPictureController::class, 'prefix' => 'Moderation'], function () {
            Route::get('/', 'showModerationPicture')->name('moderationPictures');
            Route::get('/{id}_PictureAccept', 'accept')->name('adminpictureAccept_process');
            Route::get('/{id}_PictureDelete', 'delete')->name('adminPictureDelete_process');
        });

        // Пользователи
        Route::group(['controller' => App\Http\Controllers\Admin\Users\UsersController::class, 'prefix' => 'Users'], function () {
            Route::get('/', 'showUsers')->name('adminUsers');
            Route::get('/{id}', 'showUser')->name('adminUser');
            Route::get('/{id}/deleteProcess', 'deleteProcess')->name('deleteUser_process');
        });

        // Категории
        Route::group(['namespace' => 'Categories', 'prefix' => 'Categories'], function () {

            //Категории //TODO проблема с роутом categories
            Route::group(['controller' => App\Http\Controllers\Admin\Categories\CategoriesController::class], function () {
                Route::get('/', 'showCategories')->name('categories');
                Route::get('/AddCategory', 'addProcess')->name('addCategory_process');
                Route::get('/DeleteCategory', 'deleteProcess')->name('deleteCategory_process');
            });

            // Подкатегории
            Route::group(['controller' => App\Http\Controllers\Admin\Categories\UnderCategoriesController::class], function () {
                Route::get('/AddUnderCategory', 'addProcess')->name('addUnderCategory_process');
                Route::get('/DeleteUnderCategory', 'deleteProcess')->name('deleteUnderCategory_process');
            });
        });

        // Установка Storage:link
        Route::get('/linkstorage', function () {
            Artisan::call('storage:link');
        });
    });
});



Route::get('/phpinfo', function () {
    return phpinfo();
});

/*
Route::get('/xdebuginfo', function(){
    return xdebug_info();
});
 */