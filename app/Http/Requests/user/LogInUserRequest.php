<?php

namespace App\Http\Requests\user;
use \Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;


class LogInUserRequest extends FormRequest
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

            'email' => 'bail|required|string|email|max:255|exists:users,email',
            'password' => ['bail','required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],

        ];
    }
    public function messages(): array
    {
        return [

            'email.exists' => 'The provided email address does not exist.',
            'email.required' => 'This password is required.',
            'email.email' => 'This email is not valid.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.letters' => 'The password must contain at least one letter.',
            'password.numbers' => 'The password must contain at least one number.',
            'password.symbols' => 'The password must contain at least one symbol.',


        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'full name',
            'email' => 'email address',
        ];
    }
}
