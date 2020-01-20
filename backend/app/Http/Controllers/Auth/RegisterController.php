<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Validators\AuthValidator;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends BaseController
{
    //todo remake controller

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

//    public function register(RegisterRequest $request)
//    {
//        $user = $this->create($request);
//        return response()->json([
//            'success' => 'User with email ' . $user->email . ' was successfully registered',
//            'api_token' => $user->api_token
//        ], 200);
//    }
//
//    protected function create($data)
//    {
//        $newUser            = new User();
//        $newUser->name      = $data['name'];
//        $newUser->email     = $data['email'];
//        $newUser->password  = Hash::make($data['password']);
//        $newUser->api_token = Str::random(80);
//        $newUser->save();
//
//        return $newUser;
//    }

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

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $message = "User with email  '{$user->email}' was successfully registered";
        return $this->sendResponse($success, $message);
    }

}
