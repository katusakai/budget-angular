<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //todo remake controller
    //todo add CORS

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does\'t exist'], 401);
        }
        return response()->json([
            'success' => 'You have successfully logged in, ' . auth()->user()->name ,
            'api_token' => auth()->user()->api_token],
            200);
    }
}
