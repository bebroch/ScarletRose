<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|required|max:30|string',
            'password' => 'required|min:5|max:30|confirmed',
            'email' => 'required|email|unique:users,email'
        ]);
    }

    public function register(Request $request){

        $data = $this->validator($request);


        $user = User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        event(new Registered($user));

        if($user){
            auth('web')->login($user);
        }

        session()->flash('status', 'Регистрация прошла успешно! Пожалуйста, подтвердите свой адрес электронной почты.');

        return redirect(route('home'));
    }
}
