<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use Auth;

class ProfileController extends Controller
{
    // Личный кабинет
    public function showProfile()
    {
        $pictures = Pictures::where('user_id', '=', Auth::user()->id)->get();
        return view('personalArea.personalArea', compact('pictures'));
    }
}
