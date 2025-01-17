<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(LoginRequest $request){
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales incorrectas');
        }
        return to_route('profile.index', ['user' => auth()->user()->username]);
    }
}
