<?php


namespace App\Http\Controllers\Auth\Social;


use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Http\Request;

class GoogleController extends BaseController
{
    public function try(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->google_id  = $request->id;
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name']  =  $user->name;

            return $this->sendResponse($success, 'You have successfully logged in with Google email ' . $user->email);
        }
    }
}
