<?php

namespace App\Http\Controllers;

use App\Http\Requests\addMyPictureRequest;
use App\Models\Categories;
use App\Models\categories_pictures;
use App\Models\Exhibitions;
use App\Models\Exhibitions_pictures;
use App\Models\Pictures;
use App\Models\under_categories;
use App\Models\under_categories_pictures;
use App\Models\User;
use App\Rules\PriceOrExhibitionRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersonalAreaController extends Controller
{
    // Юзер панель
    public function showPersonalArea()
    {
        return view('personalArea.personalArea');
    }

    // Мои Картины
    public function showMyPictureForm()
    {
        $images = Pictures::all()
            ->where('user_id', '=', Auth::user()->id);

        return view('personalArea.myPictures', compact('images'));
    }

    // Добавить картину
    public function showAddMyPictureForm()
    {
        $categories = Categories::all();
        return view('personalArea.createCard', compact('categories'));
    }

    public function adderPicture(addMyPictureRequest $request)
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

        if (!empty($request->technology)) {
            foreach ($request->technology as $technique) {
                under_categories_pictures::create([
                    'under_category_id' => under_categories::find($technique)->id,
                    'picture_id' => $image->id,
                ]);
            }
        }

        return redirect(route('home'));
    }

    public function deletePicture($id)
    {
        Storage::delete(Pictures::find($id)->imagePath);
        Pictures::find($id)->delete();
        return redirect(route('myPictures'));
    }

    // Редактировать картину
    public function editMyPicture($id){
        return view('personalArea.editMyPicture');
    }

    // Изменить информацию
    public function showUpdateMyInformationForm()
    {
        return view('personalArea.aboutRefactoring');
    }

    public function updateMyInformationForm_process(Request $request)
    {
        $data = [
            'login' => $request->login ? $request->login : "",
            'firstname' => $request->firstname ? $request->firstname : "",
            'lastname' => $request->lastname ? $request->lastname : "",
            'phone' => $request->phone ? $request->phone : "",
            'about' => $request->about ? $request->about : "",
        ];

        User::where('id', '=', Auth::user()->id)->update($data);

        return redirect(route('personalArea'));
    }
}
