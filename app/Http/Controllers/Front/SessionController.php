<?php

namespace App\Http\Controllers\Front;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function login(){
        return view('front.session.login');
    }

    public function doLogin(Request $request){
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return redirect()->route('front.home');
        } else {
            return redirect()->route('front.login')->withErrors(["Usuario y/o contraseña incorrecta."]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('front.login');
    }
}
