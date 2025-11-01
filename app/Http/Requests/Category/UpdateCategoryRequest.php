<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // <-- إضافة مهمة

class UpdateCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // 1. نحصل على معرف القسم (category ID) من الرابط (route)
        // هذا يفترض أن الرابط الخاص بك هو مثلاً: /categories/{category}
        $categoryId = $this->route('category')->id;

        return [
            'name'        => [
                'sometimes',
                'required',
                'string',
                Rule::unique('categories','name')->ignore($categoryId),
                'max:255',

            ],
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'parent_id'   => [
                'nullable',
                'numeric',
                'exists:categories,id',

                Rule::notIn([$categoryId]),
            ],
            'status'      => 'nullable|boolean',
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
            'name.required' => 'The category name field is required when provided.',
            'name.string'   => 'The category name must be a string.',
            'name.max'      => 'The category name must not be greater than 255 characters.',
            'name.unique'   => 'This category name has already been taken.',

            'description.string' => 'The description must be a string.',

            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: png, jpg, jpeg, webp.',
            'image.max'   => 'The image must not be larger than 2MB.',

            'parent_id.numeric' => 'The parent ID is invalid.',
            'parent_id.exists'  => 'The selected parent category does not exist.',
            'parent_id.not_in'  => 'A category cannot be set as its own parent.',

            'status.boolean' => 'The status field must be true or false.',
        ];
    }
}
