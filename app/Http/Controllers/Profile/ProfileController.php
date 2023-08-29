<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Личный кабинет
    public function showPersonalArea()
    {
        $images = Pictures::where('user_id', '=', Auth::user()->id)->get();
        return view('personalArea.personalArea', compact('images'));
    }
}
