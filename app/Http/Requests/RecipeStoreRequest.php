<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DiscountNotExecuteAmount;

class RecipeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'file' => 'required|mimes:png,jpg,jpeg|max:6000',
            'description' => 'nullable',
            'amount' => 'required|numeric|min:0',
            'discount' => ['required', 'numeric', 'min:0', new DiscountNotExecuteAmount],
            // 'net_amount' => ['required','numeric','min:0', new ValidNetAmount($this->input('amount'), $this->input('discount'))],
            'net_amount' => 'nullable|numeric|min:0',
            'is_promotion' => 'nullable|boolean',
            'status' => 'required',
            'category_id' => 'required',
            'ingredients' => 'required|array',
            'ingredients.*' => 'integer|exists:ingredients,id',
        ];
    }
}
