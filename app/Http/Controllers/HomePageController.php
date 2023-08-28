<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Categories_pictures;
use App\Models\Exhibitions;
use App\Models\News;
use App\Models\Pictures;
use App\Models\Posters;
use App\Models\under_categories;
use App\Models\under_categories_pictures;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    // Показ картин
    public function showPictures()
    {
        $images = Pictures::orderBy('created_at', 'desc') // Сортировка по убыванию даты создания
            ->where('status', '=', 1)
            ->get();
        return view('home.pictures.pictures', compact('images'));
    }


    public function showPictures_id($id)
    {

        $image = Pictures::find($id);

        if (!$image) {
            return abort(404);
        }

        $user = User::find($image->user_id);



        $under_categories_id = under_categories_pictures::where('picture_id', '=', $image->id)
            ->get()
            ->pluck('under_category_id')
            ->toArray();

        $under_categories = under_categories::whereIn('id', $under_categories_id)->get();


        $categories = array();
        foreach ($under_categories as $under_category) {
            $cat = Categories::find($under_category->category_id)->name;
            $un_cat = $under_category->name;
            $categories += ["$cat" => "$un_cat"];
        }


        $categories[] = Categories::whereIn('id', Categories_pictures::where('picture_id', '=', $image->id)
            ->get()
            ->pluck('category_id')
            ->toArray())
            ->get();



        return view('home.pictures.picture', compact('image', 'user', 'categories'));
    }


    // Показ новостей
    public function showNews()
    {
        $news = News::all();
        return view('home.news.news', compact('news'));
    }

    public function showNews_id($id)
    {
        $new = News::find($id);
        if ($new) {
            return view('home.news.new', compact('new'));
        }
        return abort(404);
    }

    // Показ афиш
    public function showPosters()
    {

        $postersF = Posters::where(function ($query) {
            $timeNow = Carbon::now()->format('Y-m-d');
            $query->where([
                ['timeEventStart', '>', $timeNow],
            ])->orWhere('timeEventDay', '>', $timeNow);
        })->get();

        $postersA = Posters::where(function ($query) {
            $timeNow = Carbon::now()->format('Y-m-d');
            $query->where([
                ['timeEventStart', '<', $timeNow],
                ['timeEventEnd', '>', $timeNow],
            ])->orWhere('timeEventDay', '=', $timeNow);
        })->get();

        $postersP = Posters::where(function ($query) {
            $timeNow = Carbon::now()->format('Y-m-d');
            $query->where('timeEventDay', '<', $timeNow)
                ->orWhere('timeEventEnd', '<', $timeNow);
        })->get();

        return view('home.posters.posters', compact('postersA', 'postersP', 'postersF'));
    }

    public function showPosters_id($id)
    {
        $poster = Posters::find($id);
        if ($poster) {
            return view('home.posters.poster', compact('poster'));
        }
        return abort(404);
    }

    // Выставки
    public function showExhibitions()
    {

        $exhibitionsFuture = Exhibitions::where([
            ['start_at', '>', now()]
        ])->get();

        $exhibitionsActive = Exhibitions::where([
            ['start_at', '<', now()],
            ['end_at', '>', now()]
        ])->get();

        $exhibitionsPassive = Exhibitions::where([
            ['end_at', '<', now()]
        ])->get();


        return view('home.exhibitions.exhibitions', compact('exhibitionsFuture', 'exhibitionsActive', 'exhibitionsPassive'));
    }

    public function showExhibition_id($id)
    {

        $exhibition = Exhibitions::find($id);

        return view('home.exhibitions.exhibition', compact('exhibition'));
    }

    // Показ пользователей
    public function userProfile($id)
    {
        $user = User::find($id);
        $images = Pictures::where('user_id', '=', $id)->get();

        return view('home.users', compact('user', 'images'));
    }

    // Поиск
    public function search(Request $request)
    {
        $query = $request->input('search');
        $images = Pictures::search($query, $request->filter, 0);

        return view('home.pictures.formPictures', ['images' => $images, 'query' => $query]);
    }
}
