<?php

namespace App\Http\Controllers\Home\Posters;

use App\Http\Controllers\Controller;
use App\Models\Posters;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PostersController extends Controller
{
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

    public function showPoster($id)
    {
        $poster = Posters::find($id);

        return view('home.posters.poster', compact('poster'));
    }
}
