<?php

namespace App\Http\Controllers\Profile\MyPictures;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use Auth;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Поиск
    public function process(Request $request)
    {
        $query = $request->input('search');

        $pictures = Pictures::search($query, $request->filter, Auth::user()->id);

        return view('home.pictures.formPictures', ['pictures' => $pictures, 'query' => $query, 'isPersonalArea' => true]);
    }
}
