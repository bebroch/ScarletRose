<?php

namespace App\Http\Controllers\Home\Pictures;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Categories_pictures;
use App\Models\Pictures;
use App\Models\under_categories;
use App\Models\under_categories_pictures;
use App\Models\User;

class PicturesController extends Controller
{
    // Показ картин
    /**
     * Summary of showPictures
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPictures()
    {
        $pictures = Pictures::orderBy('created_at', 'desc') // Сортировка по убыванию даты создания
            ->where('status', '=', 1)
            ->get();
        return view('home.pictures.pictures', compact('pictures'));
    }

    public function showPicture($id)
    {
        $picture = Pictures::find($id);

        if (!$picture) {
            return abort(404);
        }

        $user = User::find($picture->user_id);


        $under_categories_id = under_categories_pictures::where('picture_id', '=', $picture->id)
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

        return view('home.pictures.picture', compact('picture', 'user', 'categories'));
    }
}