<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function showPictures(){
        return view('home.pictures');
    }

    public function showPictures_id(){
        return view('home.pictures');
    }

    public function showNews(){
        return view('home.news');
    }

    public function showNews_id(){
        return view('home.news');
    }

    public function showPosters(){
        return view('home.posters');
    }

    public function showPosters_id(){
        return view('home.posters');
    }
}
