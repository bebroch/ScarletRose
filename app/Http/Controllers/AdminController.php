<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminAddingCategoryRequest;
use App\Http\Requests\adminAddingNewsRequest;
use App\Http\Requests\adminAddingPosterRequest;
use App\Http\Requests\adminAddingRequest;
use App\Models\News;
use App\Models\Posters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return view('adminPanel.addPoster');
        }
        return redirect('home.home');
    }

    public function addingCategory(adminAddingCategoryRequest $request){
        if(!Auth::user()->is_admin){
            return redirect('home.home');
        }

        News::create([
            'name' => $request->title,
            'about' => $request->about,
        ]);

        return redirect(route('news'));
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
}
