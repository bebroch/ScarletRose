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
    // Админ панель
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

        $request->validate([
            'uploadPicture' => 'required|image:jpg, jpeg, png',
            'namePicture' => 'required|string',
            'technique' => 'required',
            'aboutPicture' => 'required|string'
        ]);

        $path = $request->file('uploadPicture')->store("public/images/");

        $image = Pictures::create([
            'name' => $request->namePicture,
            'imagePath' => $path,
            'about' => $request->aboutPicture,
            'user_id' => Auth::user()->id
        ]);


        under_categories_pictures::create([
            'under_category_id' => under_categories::where('name', '=', $request->technique)->id,
            'picture_id' => $image
        ]);

        return redirect(route('home'));
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
