<?php

namespace App\Http\Controllers;

use App\Http\Requests\addMyPictureRequest;
use App\Http\Requests\updateInfoMyPicture;
use App\Models\Categories;
use App\Models\categories_pictures;
use App\Models\Exhibitions;
use App\Models\Exhibitions_pictures;
use App\Models\Pictures;
use App\Models\under_categories;
use App\Models\under_categories_pictures;
use App\Models\User;
use App\Rules\PriceOrExhibitionRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersonalAreaController extends Controller
{
    // Юзер панель
    public function showPersonalArea()
    {
        $images = Pictures::where('user_id', '=', Auth::user()->id)->get();
        return view('personalArea.personalArea', compact('images'));
    }

    // Мои Картины
    public function showMyPictureForm()
    {
        $images = Pictures::all()
            ->where('user_id', '=', Auth::user()->id);

        return view('personalArea.myPictures', compact('images'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $images = Pictures::search($query, $request->filter, Auth::user()->id);

        return view('personalArea.myPictures', ['images' => $images, 'query' => $query]); // Поменять
    }

    // Добавить картину
    public function showAddMyPictureForm()
    {
        $isFull = false;
        $categories = Categories::all();

        $countPicture = Pictures::where([['user_id', '=', Auth::user()->id],['status', '=', 0]])->count();
        if ($countPicture >= 5) {
            $isFull = true;
            session()->flash('status', 'Вы уже отправили 5 картин на проверку');
        }

        return view('personalArea.createCard', compact('categories', 'isFull'));
    }

    public function adderPicture(addMyPictureRequest $request)
    {
        // Путь до картинки, размеры картинки
        $path = $request->file('uploadPicture')->store("public/images/");

        // картинка идёт в ДБ
        $image = Pictures::create([
            'name' => $request->namePicture,
            'imagePath' => $path,
            'about' => $request->aboutPicture,
            'user_id' => Auth::user()->id,
            'width' => $request->width,
            'height' => $request->height,
            'price' => $request->price ? $request->price : null,
        ]);

        if (!empty($request->exhibitions)) {
            foreach ($request->exhibitions as $exhibition) {
                Exhibitions_pictures::create([
                    'exhibition_id' => Exhibitions::find($exhibition)->id,
                    'picture_id' => $image->id,
                ]);
            }
        }

        if (!empty($request->categories)) {
            foreach ($request->categories as $category) {
                Categories_pictures::create([
                    'category_id' => Categories::find($category)->id,
                    'picture_id' => $image->id,
                ]);
            }
        }


        if (!empty($request->under_categories)) {
            foreach ($request->under_categories as $under_category) {
                under_categories_pictures::create([
                    'under_category_id' => under_categories::find($under_category)->id,
                    'picture_id' => $image->id,
                ]);
            }
        }

        session()->flash('status', 'Ваша работа передана на проверку.');

        return redirect(route('home'));
    }

    public function deletePicture($id)
    {
        Storage::delete(Pictures::find($id)->imagePath);
        Pictures::find($id)->delete();
        session()->flash('status', 'Ваша картина успешно удалена');
        return redirect(route('myPictures'));
    }

    // Редактировать картину
    public function editMyPicture($id)
    {
        $picture = Pictures::find($id);
        return view('personalArea.editMyPicture', compact('picture'));
    }

    public function editMyPicture_process(updateInfoMyPicture $request)
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

    // Изменить информацию
    public function showUpdateMyInformationForm()
    {
        return view('personalArea.aboutRefactoring');
    }

    public function updateMyInformationForm_process(Request $request)
    {
        $data = [
            'login' => $request->login ? $request->login : "",
            'firstname' => $request->firstname ? $request->firstname : "",
            'lastname' => $request->lastname ? $request->lastname : "",
            'phone' => $request->phone ? $request->phone : "",
            'about' => $request->about ? $request->about : "",
        ];

        User::find(Auth::user()->id)->update($data);

        return redirect(route('personalArea'));
    }
}
