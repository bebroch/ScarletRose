<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Pictures;
use App\Models\Posters;
use App\Models\User;

class HomePageController extends Controller
{
    public function showPictures(){
        $images = Pictures::all();
        return view('home.pictures.pictures', compact('images'));
    }

    public function showPictures_id($id){
        $image = Pictures::find($id);
        $user = User::find($image->user_id)->login;
        if($image){
            return view('home.pictures.picture', compact('image', 'user'));
        }
        return abort(404);
    }

    public function showNews(){
        $news = News::all();
        return view('home.news.news', compact('news'));
    }

    public function showNews_id($id){
        $new = News::find($id);
        if($new){
            return view('home.news.new', compact('new'));
        }
        return abort(404);
    }

    public function showPosters(){
        $posters = Posters::all();
        return view('home.posters.posters', compact('posters'));
    }

    public function showPosters_id($id){
        $poster = Posters::find($id);
        if($poster){
            return view('home.posters.poster', compact('poster'));
        }
        return abort(404);
    }
}
