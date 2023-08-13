<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('login');
    }

    public function logout(){
        auth('web')->logout();
        return redirect(route('home'));
    }

    public function showRegisterForm(){
        return view('registration');
    }

    public function login(Request $req){
        $data = $req->validate([
            'login' => 'required|required|max:30|string',
            'password' => 'required|min:5|max:30'
        ]);

        if(auth('web')->attempt($data)){
            return Redirect::to(route('home'));
        }

        return Redirect::to(route('login'))->withErrors(['login' => 'Неверно указан логин или пароль.']);

    }

    public function register(Request $req){

        $data = $req->validate([
            'login' => 'required|required|max:30|string',
            'password' => 'required|min:5|max:30|confirmed',
            'email' => 'required|email|unique:users,email'
        ]);

        $user = User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if($user){
            auth('web')->login($user);
        }

        return Redirect::to(route('home'));
    }
}
