<?php

namespace App\Http\Controllers\Home\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Показ новостей
    public function showNews()
    {
        $news = News::all();
        return view('home.news.news', compact('news'));
    }

    public function showTheNews($id)
    {
        $new = News::find($id);
        return view('home.news.new', compact('new'));
    }
}
