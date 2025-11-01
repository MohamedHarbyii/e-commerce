<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;


class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * (هنا المفروض نعمل Gate للـ Admin بس حالياً هنخليها true)
     */
    public function authorize(): bool
    {
        // return $this->user()->can('create-product');
        return true; // مؤقتاً
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            // هنتعامل مع رفع الصورة (File Upload)
            'main_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // 2MB Max

        ];
    }
}
