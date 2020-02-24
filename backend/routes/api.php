<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', 'Auth\LoginController@login');
Route::post('auth/register', 'Auth\RegisterController@register');
Route::post('auth/sendPasswordResetLink', 'Auth\ResetPasswordController@sendEmail');
Route::post('auth/resetPassword', 'Auth\ChangePasswordController@process');
Route::post('auth/googleLogin', 'Auth\Social\GoogleController@try');

Route::group(['middleware' => 'auth:api'], function () {

    Route::group(['middleware' => ['role:admin']], function () {

        Route::get('admin/user', 'Admin\UserController@index');
        Route::get('admin/user/{user}', 'Admin\UserController@show');

    });

    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::post('admin/user', 'Admin\UserController@store');
        Route::put('admin/user/{user}', 'Admin\UserController@update');
        Route::delete('admin/user/{user}', 'Admin\UserController@destroy');
    });

});
