<?php


namespace App\Http\Controllers\Auth\Social;


use App\Http\Controllers\BaseController;
use App\Services\AuthServices;
use App\User;
use Illuminate\Http\Request;

class GoogleController extends BaseController
{
    public function try(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->google_id  = $request->id;

            return $this->sendResponse(AuthServices::loginData($user),
                'You have successfully logged in with Google email ' . $user->email);

        } else {
            $newUser = AuthServices::register($request->all(), 'google');
            return $this->sendResponse(AuthServices::loginData($newUser),
                'You have successfully registered and logged in with Google email ' . $newUser->email);
        }
    }
}
