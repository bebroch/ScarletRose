<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminAddingCategoryRequest;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Категории
    public function showCategories()
    {
        $categories = Categories::all();
        //TODO поменять имя adding на add/categoty
        return view('adminPanel.create.Category', compact('categories'));
    }

    public function addProcess(adminAddingCategoryRequest $request)
    {
        Categories::create([
            'name' => $request->Category,
        ]);

        return redirect(route('categories'));
    }

    public function deleteProcess(Request $request)
    {
        Categories::where('name', '=', $request->category)->delete();

        return redirect(route('categories'));
    }
}
