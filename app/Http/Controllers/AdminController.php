<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminAddingCategoryRequest;
use App\Http\Requests\adminAddingNewsRequest;
use App\Http\Requests\adminAddingPosterRequest;
use App\Http\Requests\adminAddingUnderCategoryRequest;
use App\Models\Categories;
use App\Models\News;
use App\Models\Pictures;
use App\Models\Posters;
use App\Models\under_categories;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('adminPanel.addNew');
    }

    public function addingNew(adminAddingNewsRequest $request){

        News::create([
            'name' => $request->title,
            'about' => $request->about,
        ]);

        return redirect(route('news'));
    }

    // Афиша
    public function showAddPoster(){

        return view('adminPanel.addPoster');
    }

    public function addingPoster(adminAddingPosterRequest $request){

        Posters::create([
            'name' => $request->title,
            'timeSpending' => $request->date,
            'location' => $request->location,
            'about' => $request->about,
        ]);

        return redirect(route('posters'));
    }

    // Категории
    public function showAddCategory(){

        $categories = Categories::all();
        return view('adminPanel.addCategory', compact('categories'));
    }

    public function addingCategory(adminAddingCategoryRequest $request){

        Categories::create([
            'name' => $request->nameCategory,
        ]);

        return redirect(route('addCategory'));
    }

    public function addingUnderCategory(adminAddingUnderCategoryRequest $request){

        under_categories::create([
            'name' => $request->nameUnderCategory,
            'category_id' => Categories::where('name', '=', $request->category)->first()->id,
        ]);

        return redirect(route('addCategory'));
    }

    public function deleteCategory(Request $request){

        Categories::where('name','=',$request->category)->delete();

        return redirect(route('addCategory'));
    }

    public function deleteUnderCategory(Request $request){

        under_categories::where('name','=', $request->under_category)->delete();

        return redirect(route('addCategory'));
    }

    // Поиск
    public function showSearch(){

        return view('adminPanel.AdminSearch');
    }

    // Пользователи
    public function showUsers(){

        $users = User::all();
        return view('adminPanel.users.AdminUsers', compact('users'));
    }

    public function showUser($id){
        $user = User::find($id);
        return view('adminPanel.users.AdminUser', compact('user'));
    }

    public function deleteUser(Request $request){
        User::find($request->id)->delete();
        return redirect(route('AdminUsers'));
    }

    // Удаление картины
    public function deletePicture(Request $request){

        Pictures::find($request->image)->delete();
        return redirect(route('home'));
    }
}
