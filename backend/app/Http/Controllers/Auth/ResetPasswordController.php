<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Validators\AuthValidator;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends BaseController
{
    public function sendEmail(Request $request) {
        $validator = AuthValidator::requestPassword($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if ($this->validateEmail($request->email)) {

            $this->send($request->email);
            $success['email'] = $request->email;

            return $this->sendResponse(
                $success,
                "Reset {$request->email} email is send successfully, please check your inbox.");

        } else {

            $errorMsg['email'][0] = "Email '{$request->email}' was not found on our database";

            return $this->sendError('Validation Error.', $errorMsg, 401);
        }
    }

    private function validateEmail($email) {
        return !!User::where('email', $email)->first();
    }

    private function send($email) {
        $token = $this->createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));
    }

    private function createToken($email) {
        $oldToken = Db::table('password_resets')->where('email', $email)->first();
        if ($oldToken) {
            return $oldToken->token;
        } else {
            $token = Str::random(60);
            $this->saveToken($token,$email);
            return $token;
        }
    }

    private function saveToken($token, $email) {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
    }
}
