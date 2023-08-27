<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminAddingCategoryRequest;
use App\Http\Requests\adminAddingExhibition;
use App\Http\Requests\adminAddingNewsRequest;
use App\Http\Requests\adminAddingPosterRequest;
use App\Http\Requests\adminAddingUnderCategoryRequest;
use App\Models\Categories;
use App\Models\Exhibitions;
use App\Models\News;
use App\Models\Pictures;
use App\Models\Posters;
use App\Models\under_categories;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Админ панель
    public function index()
    {

        return view('adminPanel.admin');
    }

    // Новости
    public function showAddNew()
    {

        return view('adminPanel.adding.addNew');
    }

    public function addingNew(adminAddingNewsRequest $request)
    {

        News::create([
            'name' => $request->title,
            'about' => $request->about,
        ]);

        return redirect(route('news'));
    }

    public function deleteNew_process($id){
        News::find($id)->delete();
        session()->flash('status', 'Новость успешно удалена.');
        return back();
    }

    // Афиша
    public function showAddPoster()
    {

        return view('adminPanel.adding.addPoster');
    }

    public function addingPoster(adminAddingPosterRequest $request)
    {
        if ($request->dayOrSpanDays === 'spanDays') {
            $request->validate([
                'dateStart' => 'before_or_equal:dateEnd',
                'dateEnd' => 'after_or_equal:dateStart',
            ]);
        } else {
            $request->validate([
                'date' => 'required'
            ]);
        }


        if ($request->dayOrSpanDays === 'day') {
            Posters::create([
                'name' => $request->title,
                'timeEventDay' => $request->date,
                'location' => $request->location,
                'about' => $request->about,
            ]);
        } else if ($request->dayOrSpanDays === 'spanDays') {
            Posters::create([
                'name' => $request->title,
                'timeEventStart' => $request->dateStart,
                'timeEventEnd' => $request->dateEnd,
                'location' => $request->location,
                'about' => $request->about,
            ]);
        }

        return redirect(route('posters'));
    }

    public function deletePoster_process($id){
        Posters::find($id)->delete();
        session()->flash('status', 'Афиша успешно удалена.');
        return back();
    }

    // Категории
    public function showAddCategory()
    {
        $categories = Categories::all();
        return view('adminPanel.adding.addCategory', compact('categories'));
    }

    public function addingCategory(adminAddingCategoryRequest $request)
    {
        Categories::create([
            'name' => $request->Category,
        ]);

        return redirect(route('addCategory'));
    }

    public function addingUnderCategory(adminAddingUnderCategoryRequest $request)
    {
        under_categories::create([
            'name' => $request->underCategory,
            'category_id' => Categories::where('name', '=', $request->category_for_underCategory)->first()->id,
        ]);

        return redirect(route('addCategory'));
    }

    public function deleteCategory(Request $request)
    {
        Categories::where('name', '=', $request->category)->delete();

        return redirect(route('addCategory'));
    }

    public function deleteUnderCategory(Request $request)
    {
        under_categories::where('name', '=', $request->under_category)->delete();

        return redirect(route('addCategory'));
    }

    // Выставки
    public function showAddExhibition()
    {
        return view('adminPanel.adding.addExhibition');
    }

    public function addingExhibition(adminAddingExhibition $request)
    {
        Exhibitions::create([
            'title' => $request->title,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'about' => $request->about,
        ]);

        return redirect(route('exhibitions'));
    }

    public function showEditExhibition($id)
    {
        $exhibition = Exhibitions::find($id);
        return view('adminPanel.editExhibition', compact('exhibition'));
    }
    public function showEditExhibition_process(adminAddingExhibition $request)
    {
        Exhibitions::find($request->id)->update([
            'title' => $request->title,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'about' => $request->about,
        ]);
        return redirect(route('exhibitions'));
    }

    public function deletingExhibition($id)
    {
        Exhibitions::find($id)->delete();
        return redirect(route('exhibitions'));
    }

    // Проверка картин
    public function pictureVerification()
    {
        $images = Pictures::where('status', '=', 0)->get();

        return view('adminPanel.AdminPictureVerification', compact('images'));
    }

    public function pictureAccepting($id)
    {
        $picture = Pictures::find($id);
        $picture->status = 1;
        $picture->save();
        return back();
    }

    // Пользователи
    public function showUsers()
    {
        $users = User::all();
        return view('adminPanel.users.AdminUsers', compact('users'));
    }

    public function showUser($id)
    {
        $images = Pictures::where('user_id', '=', $id)->get();
        $user = User::find($id);

        return view('adminPanel.users.AdminUser', compact('user', 'images'));
    }

    public function deleteUser(Request $request)
    {
        User::find($request->id)->delete();
        return redirect(route('AdminUsers'));
    }

    // Удаление картины
    public function deletePicture($id)
    {
        Storage::delete(Pictures::find($id)->imagePath);
        Pictures::find($id)->delete();
        return back();
    }
}
