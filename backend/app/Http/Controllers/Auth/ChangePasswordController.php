<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Validators\AuthValidator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangePasswordController extends BaseController
{
    public function process(Request $request) {

        $validator = AuthValidator::resetPassword($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->getPasswordResetTableRow($request)->count() > 0 ? $this->changePassword($request) : $this->tokenNotFoundResponse();
    }

    private function getPasswordResetTableRow($request) {
        return DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ]);
    }

    private function tokenNotFoundResponse() {
        $errorMsg['email'][] = "Token or Email is incorrect";
        return $this->sendError('Unauthorised.', $errorMsg, 422);
    }

    private function changePassword($request) {
        $user = User::whereEmail($request->email)->first();
        $user->update(['password' => bcrypt($request->password)]);
        $this->getPasswordResetTableRow($request)->delete();

        return $this->sendResponse($user, 'Password SuccessFully Changed', 201);
    }
}
