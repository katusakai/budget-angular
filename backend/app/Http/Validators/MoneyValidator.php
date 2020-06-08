<?php


namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;
class MoneyValidator
{
    public static function validate($request) {
        return Validator::make($request, [
            'sub_category_id' => 'required',
            'amount' => 'required|numeric',
            'description' => 'string|nullable'
        ]);
    }
}
