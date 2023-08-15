<?php

namespace App\Http\Controllers;

use App\Models\Pictures;
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
        return view('personalArea.myPictures');
    }

    public function showAddMyPictureForm(){
        return view('personalArea.createCard');
    }

    public function showUpdateMyInformationForm(){
        return view('personalArea.aboutRefactoring');
    }

    public function adderPicture(Request $request){

        $request->validate([
            'uploadPicture' => 'required|image:jpg, jpeg, png',
            'namePicture' => 'required|string',
            'aboutPicture' => 'required|string'
        ]);


        $path = $request->file('uploadPicture')->store("public/images/");

        $picture = Pictures::create([
            'name' => $request->namePicture,
            'imagePath' => $path,
            'about' => $request->aboutPicture,
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('home'));
    }
}
