<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'min:5', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name field must not be less than 5 characters.',
            'name.max' => 'The name field must not exceed 255 characters.',
            'username.required' => 'The username field is required.',
            'username.max' => 'The username field must not exceed 255 characters.',
            'username.unique' => 'The username field must be unique.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.unique' => 'The email field must be unique.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password field must not be less than 8 characters.',
        ];
    }
}
