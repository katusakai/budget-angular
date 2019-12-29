<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //todo remake controller
    //todo add CORS

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does\'t exist'], 401);
        }
        return response()->json(['api_token' => auth()->user()->api_token], 200);
    }
}
