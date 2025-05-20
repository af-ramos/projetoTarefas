<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is mandatory',
            'email.email' => 'Email must be valid',
            'password.required' => 'Password is mandatory',
            'password.min' => 'Password must be at least 6 characters long',
        ];
    }
}
