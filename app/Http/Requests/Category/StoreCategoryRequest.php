<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Assuming any authenticated user can create a category.
        // You can change this later based on user roles & permissions.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255|unique:categories,name',
            'slug'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048', // 2048 KB = 2MB
            'parent_id'   => 'nullable|numeric|exists:categories,id',
            'status'      => 'nullable|boolean', // Accepts 1, 0, true, false
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.required' => 'The category name field is required.',
            'name.string'   => 'The category name must be a string.',
            'name.max'      => 'The category name must not be greater than 255 characters.',
            'name.unique'   => 'This category name has already been taken.',

            'description.string' => 'The description must be a string.',

            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: png, jpg, jpeg, webp.',
            'image.max'   => 'The image must not be larger than 2MB.',

            'parent_id.numeric' => 'The parent ID is invalid.',
            'parent_id.exists'  => 'The selected parent category does not exist.',

            'status.boolean' => 'The status field must be true or false.',
        ];
    }
}
