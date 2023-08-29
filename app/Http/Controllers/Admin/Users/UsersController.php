<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Показ всех пользователей
    public function showUsers()
    {
        $users = User::all();
        return view('adminPanel.users.AdminUsers', compact('users'));
    }

    // Показ одного пользователей
    public function showUser($id)
    {
        $images = Pictures::where('user_id', '=', $id)->get();
        $user = User::find($id);

        return view('adminPanel.users.AdminUser', compact('user', 'images'));
    }

    // Процесс удаление пользователя
    public function deleteProcess($id)
    {
        User::find($id)->delete();
        return back();
    }
}
