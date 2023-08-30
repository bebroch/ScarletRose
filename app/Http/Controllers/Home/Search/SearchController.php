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
        $pictures = Pictures::search($query, $request->filter, 0);

        return view('home.pictures.formPictures', ['pictures' => $pictures, 'query' => $query]);
    }
}
