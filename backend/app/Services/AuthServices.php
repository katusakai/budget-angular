<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Str;

class AuthServices
{
    public static function register($input, $type)
    {
        switch ($type) {

            case 'none':
                $input['password'] = bcrypt($input['password']);
                $user = User::create($input);
                break;

            case 'google':
                $user = new User();
                $user->name      = $input['name'];
                $user->email     = $input['email'];
                $user->google_id = $input['id'];
                $user->password  = bcrypt(Str::random(20));
                $user->save();
                break;

            case 'facebook':
                $user = new User();
                $user->name        = $input['name'];
                $user->email       = $input['email'];
                $user->facebook_id = $input['id'];
                $user->password    = bcrypt(Str::random(20));
                $user->save();
                break;
        }

        return $user;
    }

    public static function loginData($user) {
        $data['token'] = $user->createToken('MyApp')-> accessToken;
        $data['name']  = $user->name;
        $data['id'] =  $user->id;
        return $data;
    }
}
