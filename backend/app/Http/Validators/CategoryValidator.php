<?php

namespace App\Http\Validators;

class CategoryValidator extends AbstractValidator
{
    protected function initializeRules(): void
    {
        $this->rules = [
            'name' => ['string','required', 'unique:category']
        ];
    }
}
