<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
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
        $roleId = $this->route('role')->id;

        return [
            'name' => [
                'required',
                Rule::unique('roles')->ignore($roleId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A name role is required',
            'name.unique' => 'The name role is already in use',
        ];
    }
}
