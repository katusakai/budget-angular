<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;
class MoneyValidator
{
    public static function validate($request) {
        return Validator::make($request, [
            'sub_category_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'description' => 'string|nullable',
            'user_id' => 'required|numeric|exists:users,id'
        ],
        [
            'sub_category_id.required' => 'Subcategory is required',
            'user_id.exists' => 'User does not exist'
        ]);
    }
}
