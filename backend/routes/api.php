<?php

use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\Social\FacebookController;
use App\Http\Controllers\Auth\Social\GoogleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MoneyFlowController;
use App\Http\Controllers\SubCategoryController;

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
Route::prefix('auth/')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register'])->middleware('can-register');
    Route::post('sendPasswordResetLink', [ResetPasswordController::class, 'sendEmail']);
    Route::post('resetPassword', [ChangePasswordController::class, 'process']);
    Route::post('googleLogin', [GoogleController::class, 'try'])->middleware('google-login');
    Route::post('facebookLogin', [FacebookController::class, 'try'])->middleware('facebook-login');
});

Route::get('admin/configuration/{id}', [ConfigurationController::class, 'show']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/user', [UserController::class, 'user']);
    Route::get('/roles', [UserController::class, 'roles']);

        Route::group(['middleware' => ['role:admin|super-admin']], function () {

            Route::get('admin/user', [\App\Http\Controllers\Admin\UserController::class, 'index']);
            Route::get('admin/user/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show']);
            Route::get('admin/role', [RoleController::class, 'index']);

        });

    Route::group(['middleware' => ['role:super-admin']], function () {

        Route::get('admin/configuration', [ConfigurationController::class, 'index']);
        Route::put('admin/configuration/{id}', [ConfigurationController::class, 'update']);

        Route::post('admin/user', [\App\Http\Controllers\Admin\UserController::class, 'store']);
        Route::put('admin/user/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update']);
        Route::delete('admin/user/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy']);

        Route::put('admin/role/{role}/{user}', [RoleController::class, 'update']);

        Route::get('admin/category', [CategoryController::class, 'index'])->name('category.index');
        Route::put('admin/category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('admin/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

});

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/category', [CategoryController::class, 'get'])->name('category.get');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
    Route::post('/subcategory', [SubCategoryController::class, 'store'])->name('subcategory.store');

    Route::get('/money/{user}/{date}', [MoneyFlowController::class, 'index'])->name('money.index');
    Route::post('/money', [MoneyFlowController::class, 'store'])->name('money.store');
    Route::put('/money/{id}', [MoneyFlowController::class, 'update'])->name('money.update');
    Route::delete('/money/{id}', [MoneyFlowController::class, 'destroy'])->name('money.destroy');

});
