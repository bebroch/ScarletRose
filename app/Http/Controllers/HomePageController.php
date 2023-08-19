<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Pictures;
use App\Models\Posters;
use App\Models\under_categories;
use App\Models\under_categories_pictures;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class HomePageController extends Controller
{
    // Показ картин
    public function showPictures(){
        $images = Pictures::all();
        return view('home.pictures.pictures', compact('images'));
    }

    public function showPictures_id($id){
        $image = Pictures::find($id);
        $user = User::find($image->user_id);

        if($image){
            return view('home.pictures.picture', compact('image', 'user'));
        }
        return abort(404);
    }

    // Показ новостей
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

    // Показ афиш
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

    // Показ пользователей
    public function userProfile($id){
        $user = User::find($id);

        return view('home.users', compact('user'));

    }
}
