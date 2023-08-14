<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateCardController extends Controller
{
    public function create(){
        return view('personalArea.createCard');
    }

    public function delite(){
        return view('personalArea.createCard');
    }
}
