<?php


namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

class SubCategoryValidator
{
    public static function validate($request) {
        return Validator::make($request, [
            'category_id' => 'required|numeric',
            'name' => 'string|required'
        ],
        [
            'category_id.required' => 'Category is required'
        ]);
    }
}
