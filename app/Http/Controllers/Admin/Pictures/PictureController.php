<?php

namespace App\Http\Controllers\Admin\Pictures;

use App\Http\Controllers\Controller;
use App\Http\Requests\addMyPictureRequest;
use App\Http\Requests\addPictureRequest;
use App\Models\Categories;
use App\Models\Categories_pictures;
use App\Models\Exhibitions;
use App\Models\Exhibitions_pictures;
use App\Models\Pictures;
use App\Models\under_categories;
use App\Models\under_categories_pictures;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    // Добавить картину
    public function showCreaterPicture()
    {
        $categories = Categories::all();

        return view('adminPanel.create.Picture', compact('categories'));
    }

    public function process(addPictureRequest $request)
    {
        // Путь до картинки, размеры картинки
        $path = $request->file('uploadPicture')->store("public/images");

        // Создаём нового пользователя
        $user = User::create([
            'login' => $request->UserFirstName . " " . $request->UserLastName,
            'firstname' => $request->UserFirstName,
            'lastname' => $request->UserLastName,
            'email' => $request->UserFirstName . "_" . $request->UserLastName . "@email.com",
            'password' => bcrypt(env("USER_PASSWORD", "1"))
        ]);

        $user->firstname = $request->UserFirstName;
        $user->lastname = $request->UserLastName;

        $user->save();

        // картинка идёт в ДБ
        $pictures = Pictures::create([
            'name' => $request->namePicture,
            'imagePath' => $path,
            'about' => $request->aboutPicture,
            'DateCreate' => $request->yearCreate,
            'user_id' => $user->id,
            'width' => $request->width,
            'height' => $request->height,
            'price' => $request->price ? $request->price : null,
            'status' => 1
        ]);

        if (!empty($request->exhibitions)) {
            foreach ($request->exhibitions as $exhibition) {
                Exhibitions_pictures::create([
                    'exhibition_id' => Exhibitions::find($exhibition)->id,
                    'picture_id' => $pictures->id,
                ]);
            }
        }

        if (!empty($request->categories)) {
            foreach ($request->categories as $category) {
                Categories_pictures::create([
                    'category_id' => Categories::find($category)->id,
                    'picture_id' => $pictures->id,
                ]);
            }
        }


        if (!empty($request->under_categories)) {
            foreach ($request->under_categories as $under_category) {
                under_categories_pictures::create([
                    'under_category_id' => under_categories::find($under_category)->id,
                    'picture_id' => $pictures->id,
                ]);
            }
        }

        session()->flash('status', 'Картинка успешно добавлена');

        return redirect(route('pictures'));
    }
}