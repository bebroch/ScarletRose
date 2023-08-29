<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminAddingNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function showCreateNews()
    {
        return view('adminPanel.create.News');
    }

    public function createProcess(adminAddingNewsRequest $request)
    {
        News::create([
            'name' => $request->title,
            'about' => $request->about,
        ]);

        return redirect(route('news'));
    }

    public function deleteProcess($id)
    {
        News::find($id)->delete();
        //TODO Возможно нужно добавить div для секции V
        session()->flash('status', 'Новость успешно удалена.');
        return back();
    }

}
