<?php


namespace App\Http\Controllers\Auth\Social;


use App\Http\Controllers\BaseController;
use App\Services\AuthServices;
use App\Models\User;
use Illuminate\Http\Request;

class FacebookController extends BaseController
{
    public function try(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->facebook_id  = $request->id;

            return $this->sendResponse(AuthServices::loginData($user),
                'You have successfully logged in with Facebook ' . $user->email);

        } else {
            $newUser = AuthServices::register($request->all(), 'facebook');
            return $this->sendResponse(AuthServices::loginData($newUser),
                'You have successfully registered and logged in with Facebook ' . $newUser->email);
        }
    }
}
