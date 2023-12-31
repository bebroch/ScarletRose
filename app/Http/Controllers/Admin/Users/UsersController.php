<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Pictures;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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
        $pictures = Pictures::where('user_id', '=', $id)->get();
        $user = User::find($id);

        return view('adminPanel.users.AdminUser', compact('user', 'pictures'));
    }

    // Процесс удаление пользователя
    public function deleteProcess($id)
    {
        $user = User::find($id);

        $pictures = Pictures::where('user_id', $user->id)->get();

        foreach ($pictures as $picture) {
            Storage::delete($picture->imagePath);
            $picture->delete();
        }

        $user->delete();
        return redirect(route('pictures'));
    }
}