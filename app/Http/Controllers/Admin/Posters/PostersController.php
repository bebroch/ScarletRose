<?php

namespace App\Http\Controllers\Admin\Posters;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminAddingPosterRequest;
use App\Models\Posters;
use Illuminate\Http\Request;

class PostersController extends Controller
{
    public function showCreatePoster()
    {
        return view('adminPanel.create.Poster');
    }

    public function createProcess(adminAddingPosterRequest $request)
    {
        if ($request->dayOrSpanDays === 'spanDays') {
            $request->validate([
                'dateStart' => 'before_or_equal:dateEnd',
                'dateEnd' => 'after_or_equal:dateStart',
            ]);

            Posters::create([
                'name' => $request->title,
                'timeEventStart' => $request->dateStart,
                'timeEventEnd' => $request->dateEnd,
                'location' => $request->location,
                'about' => $request->about,
            ]);
        }
        else {
            $request->validate(['date' => 'required']);

            Posters::create([
                'name' => $request->title,
                'timeEventDay' => $request->date,
                'location' => $request->location,
                'about' => $request->about,
            ]);
        }

        return redirect(route('posters'));
    }

    public function deleteProcess($id)
    {
        Posters::find($id)->delete();
        session()->flash('status', 'Афиша успешно удалена.');
        return back();
    }
}
