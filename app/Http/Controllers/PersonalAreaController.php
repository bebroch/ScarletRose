<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalAreaController extends Controller
{
    public function showPersonalArea(){
        return view('personalArea.personalArea');
    }

    public function showMyPictureForm(){
        return view();
    }

    public function showAddMyPictureForm(){
        return view();
    }

    public function showUpdateMyInformationForm(){
        return view();
    }
}
