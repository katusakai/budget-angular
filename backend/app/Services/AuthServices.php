<?php


namespace App\Services;


use App\User;

class AuthServices
{
    public static function register($input)
    {
        $input['password'] = bcrypt($input['password']);
        return User::create($input);
    }
}
