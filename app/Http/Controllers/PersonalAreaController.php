<?php

namespace App\Http\Controllers;

use App\Models\Pictures;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersonalAreaController extends Controller
{
    public function showPersonalArea(){
        return view('personalArea.personalArea');
    }

    public function showMyPictureForm(){
        $images = Pictures::all()
            ->where('user_id', '=', Auth::user()->id);

        return view('personalArea.myPictures', compact('images'));
    }

    public function showAddMyPictureForm(){
        return view('personalArea.createCard');
    }

    public function adderPicture(Request $request){

        $request->validate([
            'uploadPicture' => 'required|image:jpg, jpeg, png',
            'namePicture' => 'required|string',
            'aboutPicture' => 'required|string'
        ]);


        $path = $request->file('uploadPicture')->store("public/images/");

        Pictures::create([
            'name' => $request->namePicture,
            'imagePath' => $path,
            'about' => $request->aboutPicture,
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('home'));
    }

    public function showUpdateMyInformationForm(){
        return view('personalArea.aboutRefactoring');
    }

    public function updateMyInformationForm_process(Request $request){
        dump($request);
        dd($request->test);


        $data = [
            'login' => $request->login,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'about' => $request->about,
        ];

        $user = Auth::user();
        User::update($user->id, $data);
    }
}
