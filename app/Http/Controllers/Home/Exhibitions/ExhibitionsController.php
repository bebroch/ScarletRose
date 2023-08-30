<?php

namespace App\Http\Controllers\Home\Exhibitions;

use App\Http\Controllers\Controller;
use App\Models\Exhibitions;
use Illuminate\Http\Request;

class ExhibitionsController extends Controller
{
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

    public function showExhibition($id)
    {
        $exhibition = Exhibitions::find($id);

        return view('home.exhibitions.exhibition', compact('exhibition'));
    }
}
