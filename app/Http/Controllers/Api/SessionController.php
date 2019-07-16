<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class SessionController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]))
        {
            $user = Auth::user();
            $user['token'] =  $user->createToken('RepoWeb')->accessToken;
            return response()->json([
                'user' => $user,
                'message' => 'Login con éxito'
            ], 200);
        }

        return response()->json([
            'message' => 'Login fallido, favor de checar credenciales e intentar de nuevo'
        ], 400);
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
             return response()->json([
                'message' => 'Favor de proporcionar el nombre, correo y la contraseña'
            ], 400);
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $user['token'] =  $user->createToken('RepoWeb')->accessToken;

       return response()->json([
            'user' => $user,
            'message' => 'Usuario generado exitósamente'
        ], 200);
    }
}
