<?php

namespace App\Http\Validators;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class SubCategoryValidator extends AbstractValidator
{

    protected function initializeRules(): void
    {

        $this->rules = [
            'category_id' => 'required|numeric|exists:categories,id',
            'name' => ['string','required', $this->getUniqueCategoryAndNameRule()]
        ];

        $this->messages = [
            'name.unique' => 'This name with this category already exists',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Category does not exist',
        ];
    }

    /**
     * @return Unique|null
     */
    protected function getUniqueCategoryAndNameRule()
    {
        if (isset(request()['category_id'])) {
            $uniqueCategoryAndNameRule =
                Rule::unique('sub_categories')->where(function ($query) {
                    return $query->where('name', request()['name'])
                        ->where('category_id', request()['category_id']);
                });
        } else {
            $uniqueCategoryAndNameRule = null;
        }
        return $uniqueCategoryAndNameRule;
    }
}
