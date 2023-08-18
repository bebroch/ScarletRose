<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminAddingCategoryRequest;
use App\Http\Requests\adminAddingNewsRequest;
use App\Http\Requests\adminAddingPosterRequest;
use App\Http\Requests\adminAddingRequest;
use App\Http\Requests\adminAddingUnderCategoryRequest;
use App\Models\Categories;
use App\Models\News;
use App\Models\Pictures;
use App\Models\Posters;
use App\Models\under_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Админ панель
    public function index(){
        if(Auth::user()->is_admin){
            return view('adminPanel.admin');
        }
        return redirect('home.home');
    }

    // Новости
    public function showAddNew(){
        if(Auth::user()->is_admin){
            return view('adminPanel.addNew');
        }
        return redirect('home.home');
    }

    public function addingNew(adminAddingNewsRequest $request){
        if(!Auth::user()->is_admin){
            return redirect('home.home');
        }

        News::create([
            'name' => $request->title,
            'about' => $request->about,
        ]);

        return redirect(route('news'));
    }

    // Афиша
    public function showAddPoster(){
        if(Auth::user()->is_admin){
            return view('adminPanel.addPoster');
        }
        return redirect('home.home');
    }

    public function addingPoster(adminAddingPosterRequest $request){
        if(!Auth::user()->is_admin){
            return redirect('home.home');
        }

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
        if(Auth::user()->is_admin){
            $categories = Categories::all();
            return view('adminPanel.addCategory', compact('categories'));
        }
        return redirect('home.home');
    }

    public function addingCategory(adminAddingCategoryRequest $request){
        if(!Auth::user()->is_admin){
            return redirect('home.home');
        }

        Categories::create([
            'name' => $request->nameCategory,
        ]);

        return redirect(route('addCategory'));
    }

    public function addingUnderCategory(adminAddingUnderCategoryRequest $request){
        if(!Auth::user()->is_admin){
            return redirect('home.home');
        }

        under_categories::create([
            'name' => $request->nameUnderCategory,
            'category_id' => Categories::where('name', '=', $request->category)->first()->id,
        ]);

        return redirect(route('addCategory'));
    }

    public function deleteCategory(Request $request){
        if(!Auth::user()->is_admin){
            return redirect('home.home');
        }

        Categories::where('name','=',$request->category)->delete();

        return redirect(route('addCategory'));
    }

    public function deleteUnderCategory(Request $request){
        if(!Auth::user()->is_admin){
            return redirect('home.home');
        }

        under_categories::where('name','=', $request->under_category)->delete();

        return redirect(route('addCategory'));
    }

    // Поиск
    public function showSearch(){
        if(Auth::user()->is_admin){
            return view('adminPanel.AdminSearch');
        }
        return redirect('home.home');
    }

    // Пользователи
    public function showUsers(){
        if(Auth::user()->is_admin){
            return view('adminPanel.AdminUser');
        }
        return redirect('home.home');
    }

    // Удаление картины
    public function deletePicture(Request $request){
        Pictures::find($request->image)->delete();
        return redirect(route('home'));
    }
}
