<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function process(Request $request){
        $data = [
            'login' => $request->login,
            'password' => $request->password,
        ];

        if(auth('web')->attempt($data)){
            return redirect(route('home'));
        }

        return redirect(route('login'))->withErrors(['login' => 'Неверно указан логин или пароль.']);
    }
}
