<?php

namespace App\Http\Validators;

abstract class AbstractValidator
{
    /**
     * Validation rules
     * @var array|string[]
     */
    protected array $rules;

    /**
     * Custom messages for some rules
     * @var array|string[]
     */
    protected array $messages;

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
}
