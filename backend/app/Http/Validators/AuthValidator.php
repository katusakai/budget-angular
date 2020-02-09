<?php


namespace App\Http\Validators;


use Illuminate\Support\Facades\Validator;

class AuthValidator
{
    public static function register($request)
    {
        return Validator::make($request, [
            'name' => 'required|string|max:255|min:4',
            'email' => 'required|string|email|max:255|min:10|unique:users',
            'password' => 'required|string|max:255|min:8',
            'password_confirmation' => 'required|string|max:255|min:8|same:password',
        ]);

    }

    public static function login($request)
    {
        return Validator::make($request, [
            'email' => 'required|string|email|max:255|min:10',
            'password' => 'required|string|max:255|min:8'
        ]);

    }

    public static function requestPassword($request)
    {
        return Validator::make($request, [
            'email' => 'required|string|email|max:255|min:10',
        ]);

    }
}
