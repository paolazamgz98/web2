<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function login(){
        return view('admin.session.login');
    }

    public function doLogin(Request $request){
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            return redirect()->route('admin.locations.index');
        } else {
            return redirect()->route('admin.login')->withErrors(["Usuario y/o contraseña incorrecta."]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
