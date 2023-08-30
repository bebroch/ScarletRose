<?php

namespace App\Http\Controllers\Profile\MyPictures;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use Auth;
use Illuminate\Http\Request;

class MyPicturesController extends Controller
{
    // Мои Картины
    public function showMyPicture()
    {
        $images = Pictures::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('personalArea.myPictures', compact('images'));
    }
}
