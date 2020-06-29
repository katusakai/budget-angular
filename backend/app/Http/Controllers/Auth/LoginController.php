<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Validators\AuthValidator;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Login api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = AuthValidator::login($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $credentials = request(['email', 'password']);
        $errorMsg = [];

        if(Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;
            $success['id'] =  $user->id;

            return $this->sendResponse($success, 'You have successfully logged in, ' . auth()->user()->name);
        } else{

            if(!User::where('email', $credentials['email'])->first()) {

                $errorMsg['email'][] = "Email '{$credentials['email']}' does not exist";

             } else if (!auth()->attempt($credentials)) {

                $errorMsg['password'][] = "Mismatched password for email '{$credentials['email']}'";
            }

            return $this->sendError('Unauthorised', $errorMsg);
        }
    }
}
