<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminAddingUnderCategoryRequest;
use App\Models\Categories;
use App\Models\under_categories;
use Illuminate\Http\Request;

class UnderCategoriesController extends Controller
{
    public function addProcess(adminAddingUnderCategoryRequest $request)
    {
        under_categories::create([
            'name' => $request->underCategory,
            'category_id' => Categories::where('name', '=', $request->category_for_underCategory)->first()->id,
        ]);

        return redirect(route('categories'));
    }

    public function deleteProcess(Request $request)
    {
        under_categories::where('name', '=', $request->under_category)->delete();

        return redirect(route('categories'));
    }
}
