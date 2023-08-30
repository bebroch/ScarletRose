<?php

namespace App\Http\Controllers\Profile\MyPictures\DeletePicture;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use Storage;

class DeletePictureController extends Controller
{
    // Процесс удаления картины
    public function process($id)
    {
        Storage::delete(Pictures::find($id)->imagePath);
        Pictures::find($id)->delete();
        session()->flash('status', 'Ваша картина успешно удалена');
        return redirect(route('myPictures'));
    }
}
