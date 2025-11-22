<?php

namespace App\Http\Requests\CartItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id'=>'required',
            'quantity'=>'required',
            'cart_id'=>'required',
        ];
    }
    public function messages(): array{
        return [
            'quantity.required' => 'Pick at least one product.',
            'product_id.required' => 'The product is required.',

        ];
    }
}
