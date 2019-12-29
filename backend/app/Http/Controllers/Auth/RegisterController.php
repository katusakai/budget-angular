<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //todo remake controller

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->create($request);
        return response()->json([
            'success' => 'User with email ' . $user->email . ' was successfully registered',
            'api_token' => $user->api_token
        ], 200);
    }

    protected function create($data)
    {
        $newUser            = new User();
        $newUser->name      = $data['name'];
        $newUser->email     = $data['email'];
        $newUser->password  = Hash::make($data['password']);
        $newUser->api_token = Str::random(80);
        $newUser->save();

        return $newUser;
    }

}
