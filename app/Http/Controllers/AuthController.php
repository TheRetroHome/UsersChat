<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function registerForm(){
        return view('authAndRegister.register');
    }

    public function loginForm(){
        return view('authAndRegister.login');
    }
    public function register(RegisterRequest $request){
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
    Auth::login($user);
    return redirect()->route('home')->with('success','Регистрация пройдена');
    }
    public function login(LoginRequest $request){
        Auth::attempt($request->only('name','password'));
        return redirect()->route('home')->with('success','Авторизация пройдена');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with('success','Вы успешно разлогинились!');
    }
}
