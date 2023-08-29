<?php

namespace App\Http\Controllers\Admin\Exhibitions;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminAddingExhibition;
use App\Models\Exhibitions;
use Illuminate\Http\Request;

class ExhibitionsController extends Controller
{
    // Показ выставок
    public function showCreateExhibition()
    {
        return view('adminPanel.create.Exhibition');
    }

    // Процесс добавления выставки
    public function createProcess(adminAddingExhibition $request)
    {
        Exhibitions::create([
            'title' => $request->title,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'about' => $request->about,
        ]);

        return redirect(route('exhibitions'));
    }

    // Показ окна для реадктирования выставки
    public function showEditExhibition($id)
    {
        $exhibition = Exhibitions::find($id);
        return view('adminPanel.editExhibition', compact('exhibition'));
    }

    // Процесс редактирования выставки
    public function editProcess(adminAddingExhibition $request)
    {
        Exhibitions::find($request->id)->update([
            'title' => $request->title,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'about' => $request->about,
        ]);
        return redirect(route('exhibitions'));
    }

    // Процесс удаления выставки
    public function deleteProcess($id)
    {
        Exhibitions::find($id)->delete();
        return redirect(route('exhibitions'));
    }
}
