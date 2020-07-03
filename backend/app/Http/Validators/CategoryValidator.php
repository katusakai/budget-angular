<?php


namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

class CategoryValidator
{
    public static function validate($request) {
        return Validator::make($request, [
            'name' => 'string|required|unique:categories'
        ]);
    }
}
