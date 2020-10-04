<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

class MoneyValidator extends AbstractValidator
{
    protected function initializeRules(): void {
        $this->rules = [
            'sub_category_id' => 'required|numeric|exists:sub_categories,id',
            'amount' => 'required|numeric',
            'description' => 'string|nullable',
            'user_id' => 'required|numeric|exists:users,id'
        ];
        $this->messages = [
            'sub_category_id.required' => 'Subcategory is required',
            'sub_category_id.exists' => 'Subcategory does not exist',
            'user_id.exists' => 'User does not exist'
        ];
    }

    /**
     * Rules for creating new entry
     * @param $request
     * @return \Illuminate\Validation\Validator
     */
    public function store($request): \Illuminate\Validation\Validator
    {
        return Validator::make($request, $this->rules,$this->messages);
    }

    /**
     * Rules for updating entry, where user id unnecessary
     * @param $request
     * @return \Illuminate\Validation\Validator
     */
    public function update($request): \Illuminate\Validation\Validator
    {
        $rules = $this->rules;
        $messages = $this->messages;
        unset($rules['user_id']);
        return Validator::make($request, $rules, $messages);
    }
}
