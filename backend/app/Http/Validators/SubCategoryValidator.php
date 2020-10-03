<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubCategoryValidator
{
    public static function validate($request) {
        if (array_key_exists ('category_id', $request)) {
            $uniqueCategoryAndNameRule =
                Rule::unique('sub_categories')->where(function ($query) use($request) {
                    return $query->where('name', $request['name'])
                        ->where('category_id', $request['category_id']);
                 });
        } else {
            $uniqueCategoryAndNameRule = null;
        }

        return Validator::make($request, [
            'category_id' => 'required|numeric',
            'name' => ['string','required', $uniqueCategoryAndNameRule,
            ]
        ],
        [
            'name.unique' => 'This name with this category already exists',
            'category_id.required' => 'Category is required'
        ]);
    }
}
