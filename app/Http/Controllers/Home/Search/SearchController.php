<?php

namespace App\Http\Controllers\Home\Search;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Поиск
    public function process(Request $request)
    {
        $query = $request->search;
        $images = Pictures::search($query, $request->filter, 0);

        return view('home.pictures.formPictures', ['images' => $images, 'query' => $query]);
    }
}
