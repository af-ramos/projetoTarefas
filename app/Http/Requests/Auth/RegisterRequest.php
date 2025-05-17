<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is mandatory',
            'email.required' => 'Email is mandatory',
            'email.email' => 'Email must be valid',
            'email.unique' => 'This email is already in use',
            'password.required' => 'Password is mandatory',
            'password.min' => 'Password must be at least 6 characters long',
        ];
    }
}
