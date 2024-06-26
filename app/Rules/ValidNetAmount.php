<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidNetAmount implements Rule
{
    protected $amount;
    protected $discount;

    public function __construct($amount, $discount)
    {
        $this->amount = $amount;
        $this->discount = $discount;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value == ($this->amount - $this->discount);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The net amount must be equal to the amount minus the discount.';
    }
}
