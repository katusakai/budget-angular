<?php


namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryValidator
{
    public static function validate($request) {
        return Validator::make($request, [
            'name' => ['string','required', 'unique:categories']
        ]);
    }
}
