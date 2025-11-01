<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 * schema="UpdateProductRequest",
 * title="Update Product Request",
 * @OA\Property(property="name", type="string", example="Updated Product"),
 * @OA\Property(property="description", type="string", example="Updated description."),
 * @OA\Property(property="price", type="number", format="float", example=150.00),
 * @OA\Property(property="stock", type="integer", example=200),
 * @OA\Property(property="image", type="string", format="binary", description="New main product image (optional).")
 * )
 */
class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return $this->user()->can('update-product');
        return true; // مؤقتاً
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // (sometimes) معناها لو الحقل موجود، اعمل validation، لو مش موجود، تجاهله
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'stock' => ['sometimes', 'required', 'integer', 'min:0'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
}
