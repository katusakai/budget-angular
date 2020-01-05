<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
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
        $errorMsg = null;

        if(!User::where('email', $credentials['email'])->first()) {
            $errorMsg = "Email \"{$credentials['email']}\" does  not exist";
        }

        if (!$errorMsg  && !auth()->attempt($credentials)) {
            $errorMsg = "Mismatched password for email \"{$credentials['email']}\"";
        }

        if ($errorMsg ) {
            return response()->json(['error' => $errorMsg], 401);
        } else {
            return response()->json([
                'success' => 'You have successfully logged in, ' . auth()->user()->name ,
                'api_token' => auth()->user()->api_token],
                200);
        }
    }
}
