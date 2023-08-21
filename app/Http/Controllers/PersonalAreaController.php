<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\categories_pictures;
use App\Models\Pictures;
use App\Models\under_categories;
use App\Models\under_categories_pictures;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersonalAreaController extends Controller
{
    // Юзер панель
    public function showPersonalArea(){
        return view('personalArea.personalArea');
    }

    // Мои Картины
    public function showMyPictureForm(){
        $images = Pictures::all()
            ->where('user_id', '=', Auth::user()->id);

        return view('personalArea.myPictures', compact('images'));
    }

    // Добавить картину
    public function showAddMyPictureForm(){
        $categories = Categories::all();
        return view('personalArea.createCard', compact('categories'));
    }

    public function adderPicture(Request $request){

        // Валидация
        $request->validate([
            'uploadPicture' => 'required|image:jpg, jpeg, png',
            'namePicture' => 'required|string',
            'aboutPicture' => 'required|string',
            'price' => 'integer|gt:0|lt:4294967295',
        ]);


        // Путь до картинки, размеры картинки
        $path = $request->file('uploadPicture')->store("public/images/");
        $data = getimagesize($request->file('uploadPicture'));

        // картинка идёт в ДБ
        $image = Pictures::create([
            'name'      => $request->namePicture,
            'imagePath' => $path,
            'about'     => $request->aboutPicture,
            'user_id'   => Auth::user()->id,
            'width'     => $data[0],
            'height'    => $data[1],
            'price'     => $request->price ? $request->price : null,
        ]);

        $technique = array();

        foreach ($request->collect() as $key => $value) {
            if (!$key)
                continue;
            if(explode(',', $key)[0] == 'technique'){
                $technique[] = explode(',', $key);
            }
        }

        foreach ($technique as $value) {
            if($value[2]){
                under_categories_pictures::create([
                    'under_category_id' => under_categories::find($value[2])->id,
                    'picture_id' => $image->id,
                ]);
            }
            else{
                Categories_pictures::create([
                    'category_id' => Categories::find($value[1]),
                    'picture_id' => $image->id,
                ]);
            }
        }

        return redirect(route('home'));
    }

    public function deletePicture($id){
        Pictures::find($id)->delete();
        return redirect(route('myPictures'));
    }

    // Изменить информацию
    public function showUpdateMyInformationForm(){
        return view('personalArea.aboutRefactoring');
    }

    public function updateMyInformationForm_process(Request $request){

        $data = [
            'login'     => $request->login ? $request->login : "",
            'firstname' => $request->firstname ? $request->firstname : "",
            'lastname'  => $request->lastname ? $request->lastname : "",
            'phone'     => $request->phone ? $request->phone : "",
            'about'     => $request->about ? $request->about : "",
        ];

        User::where('id', '=', Auth::user()->id)->update($data);

        return redirect(route('personalArea'));
    }
}
