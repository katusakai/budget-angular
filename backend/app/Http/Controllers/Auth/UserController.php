<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Contracts\Auth\Authenticatable;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Authenticatable
     */
    public function user()
    {
        return auth()->user();
    }

    public function roles()
    {
        return auth()->user()->roles->pluck('name');
    }

}
