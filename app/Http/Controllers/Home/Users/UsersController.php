<?php

namespace App\Http\Controllers\Home\Users;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Показ пользователей
    public function showUser($id)
    {
        $user = User::find($id);
        $images = Pictures::where('user_id', '=', $id)->get();

        return view('home.user', compact('user', 'images'));
    }
}
