<?php

namespace App\Http\Controllers\Profile\MyPictures\EditPicture;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateInfoMyPicture;
use App\Models\Exhibitions_pictures;
use App\Models\Pictures;
use Illuminate\Http\Request;

class EditPictureController extends Controller
{
    // Редактировать картину
    public function showEditPicture($id)
    {
        $picture = Pictures::find($id);
        return view('personalArea.myPictures.editMyPicture', compact('picture'));
    }

    public function process(updateInfoMyPicture $request)
    {

        $exhibitionsNew = $request->exhibitions;
        $exhibitionsOld = Exhibitions_pictures::where('picture_id', '=', $request->id)->pluck('exhibition_id')->toArray();

        foreach ($exhibitionsOld as $exhibition) {
            if (!in_array($exhibition, $exhibitionsNew)) {
                $exhibitionToDelete = Exhibitions_pictures::where('exhibition_id', '=', $exhibition)
                    ->where('picture_id', '=', $request->id);
                if ($exhibitionToDelete) {
                    $exhibitionToDelete->delete();
                }
            } else {
                $key = array_search($exhibition, $exhibitionsNew);
                unset($exhibitionsNew[$key]);
            }
        }

        foreach ($exhibitionsNew as $exhibitionNew) {
            Exhibitions_pictures::create([
                'exhibition_id' => $exhibitionNew,
                'picture_id' => $request->id
            ]);
        }


        Pictures::find($request->id)->update(['price' => $request->price]);

        session()->flash('status', 'Ваша картина успешно изменена');

        return redirect(route('myPictures'));
    }
}
