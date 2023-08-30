<?php

namespace App\Http\Controllers\Profile\MyPictures\CreatePicture;

use App\Http\Controllers\Controller;
use App\Http\Requests\addMyPictureRequest;
use App\Models\Categories;
use App\Models\Categories_pictures;
use App\Models\Exhibitions;
use App\Models\Exhibitions_pictures;
use App\Models\Pictures;
use App\Models\under_categories;
use App\Models\under_categories_pictures;
use Auth;

class CreatePictureController extends Controller
{
    // Добавить картину
    public function showCreaterPicture()
    {
        $isDisable = false;
        $categories = Categories::all();

        $countPicture = Pictures::where([['user_id', '=', Auth::user()->id],['status', '=', 0]])->count();
        if ($countPicture >= 5) {
            $isDisable = true;
            session()->flash('status', 'Вы уже отправили 5 картин на проверку');
        }
        if(empty(Auth::user()->firstname) && empty(Auth::user()->lastname)){
            $isDisable = true;
            session()->flash('status', 'Введите ФИО в вашем личном кабинете перед тем, как выложить картину.');
        }

        return view('personalArea.myPictures.createPicture', compact('categories', 'isDisable'));
    }

    public function process(addMyPictureRequest $request)
    {
        // Путь до картинки, размеры картинки
        $path = $request->file('uploadPicture')->store("public/images/");

        // картинка идёт в ДБ
        $image = Pictures::create([
            'name' => $request->namePicture,
            'imagePath' => $path,
            'about' => $request->aboutPicture,
            'user_id' => Auth::user()->id,
            'width' => $request->width,
            'height' => $request->height,
            'price' => $request->price ? $request->price : null,
        ]);

        if (!empty($request->exhibitions)) {
            foreach ($request->exhibitions as $exhibition) {
                Exhibitions_pictures::create([
                    'exhibition_id' => Exhibitions::find($exhibition)->id,
                    'picture_id' => $image->id,
                ]);
            }
        }

        if (!empty($request->categories)) {
            foreach ($request->categories as $category) {
                Categories_pictures::create([
                    'category_id' => Categories::find($category)->id,
                    'picture_id' => $image->id,
                ]);
            }
        }


        if (!empty($request->under_categories)) {
            foreach ($request->under_categories as $under_category) {
                under_categories_pictures::create([
                    'under_category_id' => under_categories::find($under_category)->id,
                    'picture_id' => $image->id,
                ]);
            }
        }

        session()->flash('status', 'Ваша работа передана на проверку.');

        return redirect(route('pictures'));
    }
}
