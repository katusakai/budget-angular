<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

abstract class AbstractValidator
{
    /**
     * Validation rules
     * @var array|string[]
     */
    protected array $rules = [];

    /**
     * Custom messages for some rules
     * @var array|string[]
     */
    protected array $messages = [];

    /**
     * MoneyValidator constructor.
     */
    public function __construct()
    {
        $this->initializeRules();
    }

    /**
     * Initializes arrays of rules and custom messages
     */
    abstract protected function initializeRules(): void;

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
     * Rules for updating entry
     * @param $request
     * @return \Illuminate\Validation\Validator
     */
    public function update($request): \Illuminate\Validation\Validator
    {
        return $this->store($request);
    }
}
