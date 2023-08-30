<?php

namespace App\Http\Controllers\Admin\ModerationPicture;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModerationPictureController extends Controller
{
    // Показ окна для проверки картин
    public function showModerationPicture()
    {
        $pictures = Pictures::where('status', '=', 0)->get();

        return view('adminPanel.AdminPictureVerification', compact('pictures'));
    }

    // Процесс принятия картины
    public function accept($id)
    {
        $picture = Pictures::find($id);
        $picture->status = 1;
        $picture->save();
        return back();
    }

    // Процесс удаления картины
    public function delete($id){
        Storage::delete(Pictures::find($id)->imagePath);
        Pictures::find($id)->delete();
        session()->flash('status', 'Картина успешно удалена');
        return back();
    }
}
