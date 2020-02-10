<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Validators\AuthValidator;
use App\Services\AuthServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = AuthValidator::register($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = AuthServices::register($request->all());
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $message = "User with email  '{$user->email}' was successfully registered";

        return $this->sendResponse($success, $message);
    }

}
